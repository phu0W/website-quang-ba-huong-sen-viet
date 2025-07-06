@extends('admin.master')
@section('title','Thêm tài khoản')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm tài khoản</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên">
                    @error('name')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                    @error('email')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                    @error('phone')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                    @error('password')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="">
                    @error('confirm_password')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Chức vụ</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $item)
                            <option value="{{$item->id}}">{{$item->description}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection


