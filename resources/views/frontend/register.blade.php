@extends('frontend.master')
@section('frt')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Đăng ký</h2>
                        </div>
                        <form class="needs-validation" novalidate method="POST">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="name" placeholder="Nguyễn Thị A" required maxlength="100" name="name">
                                <label for="name">Họ và tên</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" placeholder="you@example.com" required maxlength="100" name="email">
                                <label for="email">Địa chỉ Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="phone" placeholder="" required maxlength="100" name="phone">
                                <label for="name">Số điện thoại</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="address" placeholder="" required maxlength="100" name="address">
                                <label for="name">Địa chỉ</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select name="gender" id="" class="form-control">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                                <label for="gender">Giới tính</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                <label for="">Mật khẩu</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="" required>
                                <label for="confirm_password">Xác nhận mật khẩu</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection