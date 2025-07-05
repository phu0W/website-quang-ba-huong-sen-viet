<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Course;
use Str;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // đổi lại đường dẫn phù hợp 
        $vnp_Returnurl =  "http://127.0.0.1:8000/vnpay-return";
        $vnp_TmnCode = "3Q6B36Y1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "E1CJPWIGMS3WUVSTAJXPOTTT4WNJZ3DN"; //Chuỗi bí mật

        //$vnp_TxnRef = rand(1, 10000);
        $txn_ref = $request->input('txn_ref', Str::random(10));
        if (!$request->has('txn_ref')) {
            $pending = session('pending_payments', []);
            $pending[$txn_ref] = [
                'type' => 'cart',
            ];
            session(['pending_payments' => $pending]);
        }
        $vnp_TxnRef = $txn_ref;
        $vnp_OrderInfo = 'Thanh toán đơn hàng test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_vnpay'] * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        //$startTime = date("YmdHis");
        //$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

        $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        //"vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        // $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
        'code' => '00',
        'message' => 'success',
        'data' => $vnp_Url
        );
        if ($request->has('redirect')) {
            return redirect()->to($vnp_Url);
        } else {
            return response()->json([
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            ]);
        }

        if (isset($_POST['redirect'])) {
        
        return redirect()->to($vnp_Url);
        die();
        } else {
        echo json_encode($returnData);
        }
    }
    public function vnpay_return(Request $req){
        //dd($req);
        if($req->vnp_ResponseCode == "00"){
            try {
                $student_id = auth('stu')->id();
                $txn_ref = $req->vnp_TxnRef;
                $pending = session('pending_payments', []);
                $paymentInfo = $pending[$txn_ref] ?? null;
                if (!$paymentInfo) {
                    return redirect()->route('home.index')->with('error', 'Không tìm thấy giao dịch hợp lệ.');
                }

                if ($paymentInfo['type'] === 'buy_now') {
                    // Xử lý mua ngay
                    $payment = Payment::create([
                        'student_id' => $student_id,
                        'money' => $req->vnp_Amount / 100,
                        'note' => $req->vnp_OrderInfo,
                        'vnp_response_code' => $req->vnp_ResponseCode,
                        'code_vnpay' => $req->vnp_TransactionNo,
                        'code_bank' => $req->vnp_BankCode,
                        'time' => date('Y-m-d H:i', strtotime($req->vnp_PayDate)),
                    ]);

                    $course = $paymentInfo['course'];

                    Enrollment::create([
                        'student_id' => $student_id,
                        'course_id' => $course['id'],
                        'payment_id' => $payment->id,
                        'time' => now()
                    ]);

                    CartDetail::where('course_id', $course['id'])
                                ->whereHas('cart', function($query) use ($student_id) {
                                    $query->where('student_id', $student_id);
                                })->delete();

                    unset($pending[$txn_ref]);
                    session(['pending_payments' => $pending]);
                    return redirect()->route('home.index')->with('success', 'Mua khóa học thành công!');
                } else if($paymentInfo['type'] === 'cart') {
                    $dataPayment = [ 
                        'student_id' => $student_id,
                        'money' => $req->vnp_Amount/100,
                        'note' => $req->vnp_OrderInfo,
                        'vnp_response_code' => $req->vnp_ResponseCode,
                        'code_vnpay' => $req->vnp_TransactionNo,
                        'code_bank' => $req->vnp_BankCode,
                        'time' => date('Y-m-d H:i', strtotime($req->vnp_PayDate)),
                    ];
                    $payment = Payment::create($dataPayment);
                    // dd($payment);
                    $cartdetails = CartDetail::whereHas('cart', function($query) use ($student_id) {
                        $query->where('student_id', $student_id);
                    })
                    ->with('course:id,name,price')
                    ->get();
                    //dd($cartdetails);
                    //dd($payment);
                    //dd($cartdetails);
                    foreach($cartdetails as $cartdetail){
                        Enrollment::create([
                            'student_id' => $student_id,
                            'course_id' => $cartdetail->course->id,
                            'payment_id' => $payment->id,
                            'time' => now()
                        ]);
                    }                
                    unset($pending[$txn_ref]);
                    session(['pending_payments' => $pending]);

                    CartDetail::whereHas('cart', function($query) use ($student_id) {
                        $query->where('student_id', $student_id);
                    })->delete();
                    //dd($dataPayment);
                    
                    return redirect()->route('home.index')->with('success', 'Đăng ký khóa học thành công !');
                }
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'Đăng ký khóa học thất bại !');
            }
        }
    }

    public function buy_now($course_id)
    {
        // $data = session('pending_payments');
        // dd($data);
        $student = auth('stu')->user();
        $isEnrolled = $student->enrolledCourses()
                        ->where('course_id', $course_id)
                        ->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký khóa học này rồi!');
        }
        $course = Course::findOrFail($course_id);
        $txn_ref = Str::random(10);

        $pending = session('pending_payments', []);
        $pending[$txn_ref] = [
            'type' => 'buy_now',
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'price' => $course->price,
            ],
        ];
        session(['pending_payments' => $pending]);

        $request = new \Illuminate\Http\Request([
            'total_vnpay' => $course->price,
            'redirect' => true,
            'txn_ref' => $txn_ref,
        ]);

        return $this->vnpay_payment($request);
    }

    public function my_payment(){
        $student = auth('stu')->user();
        $payments = Payment::where('student_id', $student->id)
            ->with('enrollments.course')  // eager load enrollments và course bên trong
            ->get();

        // Lấy tất cả khóa học từ enrollments trong payments
        $courses = $payments->flatMap(function ($payment) {
            return $payment->enrollments->map(function ($enrollment) use ($payment) {
                $course = $enrollment->course;
                return (object) [
                    'course' => $course,
                    'code_vnpay' => $payment->code_vnpay,
                    'time' => $payment->time,
                    'vnp_response_code' => $payment->vnp_response_code,
                ];
            });
        })->unique(function ($item) {
            return $item->course->id . '_' . $item->code_vnpay;
        })->values();
        return view('frontend.my_payment', compact('courses','student'));
    }
    
}