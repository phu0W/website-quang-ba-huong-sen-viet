@extends('admin.master')
@section('title','Hồ sơ')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Hồ sơ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" value="{{$auth->name}}">
                    @error('name')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{$auth->email}}">
                    @error('email')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{$auth->phone}}">
                    @error('phone')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nhập mật khẩu để cập nhật</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                    @error('password')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
            </div>
          <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection


