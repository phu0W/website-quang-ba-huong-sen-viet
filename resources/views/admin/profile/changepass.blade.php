@extends('admin.master')
@section('title','Thêm tài khoản')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Đổi mật khẩu</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Mật khẩu cũ</label>
                    <input type="text" class="form-control" id="old_password" name="old_password" placeholder="">
                    @error('old_password')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu mới</label>
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


