<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Course;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl =  "http://127.0.0.1:8000/vnpay-return";
        $vnp_TmnCode = "3Q6B36Y1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "E1CJPWIGMS3WUVSTAJXPOTTT4WNJZ3DN"; //Chuỗi bí mật

        $vnp_TxnRef = rand(1, 10000);; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
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
        if($req->vnp_ResponseCode == "00"){
            try {
                $student_id = auth('stu')->id();

                if (session()->has('buy_now_course')) {
                    // Xử lý mua ngay
                    $course = session('buy_now_course');

                    Enrollment::insert([
                        'student_id' => $student_id,
                        'course_id' => $course['id'],
                    ]);

                    $dataPayment = [
                        'student_id' => $student_id,
                        'money' => $req->vnp_Amount / 100,
                        'note' => $req->vnp_OrderInfo,
                        'vnp_response_code' => $req->vnp_ResponseCode,
                        'code_vnpay' => $req->vnp_TransactionNo,
                        'code_bank' => $req->vnp_BankCode,
                        'time' => date('Y-m-d H:i', strtotime($req->vnp_PayDate)),
                    ];

                    Payment::insert($dataPayment);

                    session()->forget('buy_now_course');
                    return redirect()->route('home.index')->with('success', 'Mua khóa học thành công!');
                } else {
                    $cartdetails = CartDetail::whereHas('cart', function($query) use ($student_id) {
                        $query->where('student_id', $student_id);
                    })
                    ->with('course:id,name,price')
                    ->get();
                    //dd($cartdetails);
                    foreach($cartdetails as $cartdetail){
                        Enrollment::insert([
                            'student_id' => $student_id,
                            'course_id' => $cartdetail->course->id
                        ]);
                    }                
                    $dataPayment = [ 
                        'student_id' => $student_id,
                        'money' => $req->vnp_Amount/100,
                        'note' => $req->vnp_OrderInfo,
                        'vnp_response_code' => $req->vnp_ResponseCode,
                        'code_vnpay' => $req->vnp_TransactionNo,
                        'code_bank' => $req->vnp_BankCode,
                        'time' => date('Y-m-d H:i', strtotime($req->vnp_PayDate)),
                    ];
                    //dd($dataPayment);
                    Payment::insert($dataPayment);
                    return redirect()->route('home.index')->with('success', 'Đăng ký khóa học thành công !');
                }
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'Đăng ký khóa học thất bại !');
            }
        }
    }

    public function buy_now($course_id)
    {
        $course = Course::findOrFail($course_id);

        session(['buy_now_course' => [
            'id' => $course->id,
            'name' => $course->name,
            'price' => $course->price,
        ]]);

        $request = new \Illuminate\Http\Request([
            'total_vnpay' => $course->price,
            'redirect' => true
        ]);

        return $this->vnpay_payment($request);
    }
    
}
