<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\VerifyAccount;
use App\Mail\StuForgotPassword;
use App\Models\Student;
use App\Models\StudentResetToken;
use Hash;

class AccountController extends Controller
{
    public function login(){
        return view('frontend.login');
    }
    public function logout(){
        auth('stu')->logout();
        return redirect()->route('home.index');
    }
    public function check_login(Request $req){
        $req->validate([
            'email' => 'required|exists:students,email',
            'password' => 'required',
        ], [
            'email.required' => 'Email không được để trống',
            'email.exists' => 'Email không đúng',
            'password.required' => 'Mật khẩu không được để trống',
        ]);
        $data = $req->only('email', 'password'); // giá trị trong only() là tên các input field
        $check = auth('stu')->attempt($data);
        if($check){
            if(auth('stu')->user()->email_verified_at == ''){
                auth('stu')->logout();
                return redirect()->back()->with('error', 'Bạn chưa xác minh tài khoản !');
            }
            return redirect()->route('home.index');
        }
        return redirect()->back()->with('error', 'Kiểm tra lại thông tin đăng nhập !');
    }
    public function register(){
        return view('frontend.register');
    }
    public function check_register(Request $req){
        $req->validate([
            'name' => 'required|min:4|max:100',
            'email'=> 'required|email|min:6|max:100|unique:students',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|numeric|min:10|unique:students',
        ],
        [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'phone.min' => 'Số điện thoại phải là 10 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'confirm_password.required' => 'Xác nhận mật khẩu không được để trống',
            'confirm_password.same' => 'Xác nhận mật khẩu sai',
            'name.min' => 'Họ tên ít nhất 4 ký tự',
            'email.min' => 'Email ít nhất 6 ký tự',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'email.email' => 'Sai định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ]);
        $data = $req->only('name','email','phone','address','gender');
        $data['password'] = bcrypt($req->password);
        if($acc = Student::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('success','Đăng ký thành công, Kiểm tra email để xác nhận đăng ký.');
        }
        return redirect()->back()->with('error','Đăng ký thất bại');
    }
    public function verify($email){
        $acc = Student::where('email',$email)->whereNull('email_verified_at')->firstOrFail();
        Student::where('email',$email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('success','Xác minh thành công');
    }
    public function profile(){
        $student = auth('stu')->user();
        return view('frontend.profile', compact('student'));
    }
    public function check_profile(Request $req){
        $auth = auth('stu')->user();
        $req->validate([
            'name' => 'required|min:4|max:100',
            'email'=> 'required|email|min:6|max:100|unique:students,email,'.$auth->id,
            'phone' => 'required|numeric|min:10|unique:students,phone,'.$auth->id,
        ],
        [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'phone.min' => 'Số điện thoại phải là 10 ký tự',
            'name.min' => 'Họ tên ít nhất 4 ký tự',
            'email.min' => 'Email ít nhất 6 ký tự',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'email.email' => 'Sai định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ]);
        $data = $req->only('name','email','phone','address','gender');
        $auth->update($data);
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function check_change_password(Request $req){
        $auth = auth('stu')->user();
        $req->validate([
            'old_password' => ['required', function($attr, $value, $fail) use($auth){
                if(!Hash::check($value, $auth->password)){
                    $fail('Mật khẩu không khớp !');
                }
            }],
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $data['password'] = bcrypt($req->password);
        if($auth->update($data)){
            auth('stu')->logout();
            return redirect()->route('account.login')->with('success', 'Mật khẩu của bạn đã được cập nhật');
        }
        return redirect()->back()->with('error', 'Có lỗi xảy ra, hãy thử lại !');
    }
    public function forgot_password(){
        return view('frontend.forgot_password');
    }
    public function check_forgot_password(Request $req){
        $req->validate([
            'email' => 'required|exists:students,email',
        ], [
            'email.required' => 'Email không được để trống !',
            'email.exists' => 'Email không tồn tại !',
        ]);
        $student = Student::where('email',$req->email)->first();
        $token = \Str::random(50);
        $tokenData = [ //không dùng tới
            'email' => $req->email,
            'token' => $token,
        ];

        $check = StudentResetToken::updateOrCreate(
            ['email' => $req->email],
            ['token' => $token]
        );
        if($check){
            Mail::to($req->email)->send(new StuForgotPassword($student, $token));
            return redirect()->back()->with('success', 'Gửi email thành công, kiểm tra email để tiếp tục !'); 
        }
        return redirect()->back()->with('error', 'Có lỗi xảy ra, hãy thử lại !');    

    }

    public function reset_password($token){
        $tokenData = StudentResetToken::where('token',$token)->firstOrFail();
        return view('frontend.reset_password');
    }
    public function check_reset_password($token){
        request()->validate([
            'new_password' => 'required|min:4',
            'cf_password' => 'required|same:new_password'
        ]);
        $tokenData = StudentResetToken::where('token',$token)->firstOrFail();
        // $student = Student::where('email', $tokenData->email)->firstOrFail();
        $student = $tokenData->student;// quan hệ student trong sturesettoken, tìm học viên có email bằng email
        $data = [
            'password' => bcrypt(request(('new_password')))
        ];
        $check = $student->update($data);
        if($check){
            return redirect()->back()->with('success', 'Cập nhật mật khẩu mới thành công !'); 
        }
        return redirect()->back()->with('error', 'Có lỗi xảy ra, hãy thử lại !');    
    }
}
