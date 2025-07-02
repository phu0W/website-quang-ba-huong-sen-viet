<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:100',
            'email'=> 'required|email|min:6|max:100|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|numeric|min:10|unique:users',
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

        $data = $request->only('name','email', 'phone', 'role_id');
        $data['password'] = bcrypt($request->password);
        try{
            User::create($data);
            return redirect()->route('user.index')->with('success', 'Thêm mới thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thêm mới thất bại !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('view', $user);
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:4|max:100',
            'email'=> 'required|email|min:6|max:100|unique:users,email,'.$request->id,
            'phone' => 'required|numeric|min:10|unique:users,phone,'.$request->id,
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
        try{
            $data = $request->only(['name','email','phone','role_id']);
            $user->update($data);
            return redirect()->route('user.index')->with('success', 'Cập nhật thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    { 
        $this->authorize('delete', $user);
        try{
            if(auth()->id == $user->id() || $user->role->name == "admin"){
                return redirect()->route('user.index')->with('error', 'Xóa thất bại !');
            }
            else{
                $user->delete();
                return redirect()->route('user.index')->with('success', 'Xóa thành công !');
            }
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
}
