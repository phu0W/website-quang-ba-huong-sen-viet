@extends('frontend.master')
@section('frt')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Đăng nhập</h2>
                        </div>
                        <form method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required maxlength="100">
                                <label for="email"><i class="bi bi-envelope me-2"></i>Địa chỉ Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                <label for=""><i class="fas fa-unlock me-2"></i>Mật khẩu</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">Đăng nhập</button>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small text-success" style="text-decoration: none" href="{{route('account.forgot_password')}}">Bạn quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small text-success" style="text-decoration: none" href="{{route('account.register')}}">Bạn chưa có tài khoản?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection