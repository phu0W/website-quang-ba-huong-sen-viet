<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\PasswordResetToken;
use Mail;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function login(){
        return view('admin.login');
    }
    public function checklogin(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users',
            'password'=>'required',
        ]);
        $data = $request->all('email','password');
        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) cach1
        if(auth()->attempt($data)){
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error','Sai rồi !');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function forgotpass(){
        return view('admin.forgotpass');
    }
    public function post_forgotpass(Request $request){
        $request->validate([
            'email'=>'required|exists:users',
        ],
        [
            'email.required'=>'Bạn chưa nhập email !',
            'email.exists'=>'Email này khồng tồn tại !',
        ]);
        $user = User::where('email',$request->email)->first();
        $token = \Str::random(50);
        $tokenData = [
            'email' => $request->email,
            'token' => $token,
        ];
        if(PasswordResetToken::create($tokenData)){
            Mail::to($request->email)->send(new ForgotPassword($user, $token));
            return redirect()->route('admin.login')->with('success', 'Gửi email thành công !');
        }
        return redirect()->back()->with('error', 'Vui lòng kiểm tra lại email !');
    }
    public function getpass($token){
        $tokenData = PasswordResetToken::where('token', $token)->firstOrFail();
        $dd($tokenData);
        return view('admin.getpass');
    }
    public function changepass(){
        return view('admin.profile.changepass');
    }
    public function post_changepass(Request $request){
        $auth = auth()->user();
        $request->validate([
            'old_password' => ['required', function($attr, $value, $fail) use($auth){
                if(!Hash::check($value, $auth->password)){
                    $fail('Sai mật khẩu');
                }
            }],
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $data['password'] = bcrypt($request->password);
        if($auth->update($data)){
            auth()->logout();
            return redirect()->route('admin.login')->with('success','Cập nhật mật khẩu thành công !');
        }
        else{
            return redirect()->back()->with('error','Cập nhật thất bại !');
        }

    }
    public function profile(){
        $auth = auth()->user();
        return view('admin.profile.profile', compact('auth'));
    }
    public function post_profile(Request $request){
        $auth = auth()->user();
        $request->validate([
            'name' => 'required|min:4|max:100',
            'email'=> 'required|email|min:6|max:100|unique:users,email,'.$auth->id,
            'phone' => 'required|numeric|min:10|unique:users,phone,'.$auth->id,
            'password' => ['required', function($attr, $value, $fail) use($auth){
                if(!Hash::check($value, $auth->password)){
                    $fail('Sai mật khẩu');
                }
            }],
        ],
        [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là dạng số',
            'phone.min' => 'Số điện thoại phải là 10 ký tự',
            'name.min' => 'Họ tên ít nhất 4 ký tự',
            'email.min' => 'Email ít nhất 6 ký tự',
            'email.email' => 'Sai định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ]);

        $data = $request->only('name','email','phone');
        if($auth->update($data)){
            return redirect()->back()->with('success','Cập nhật thành công !');
        }
        else{
            return redirect()->back()->with('error','Cập nhật thất bại !');
        }
    }
}
