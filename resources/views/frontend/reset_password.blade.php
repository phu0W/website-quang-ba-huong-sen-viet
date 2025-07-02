@extends('frontend.master')
@section('frt')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold">Đặt lại mật khẩu</h2>
                        </div>
                        <form method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="" required>
                                <label for=""><i class="fas fa-unlock me-2"></i>Nhập mật khẩu mới</label>
                                @error('new_password')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="cf_password" name="cf_password" placeholder="" required>
                                <label for=""><i class="fas fa-unlock me-2"></i>Xác nhận mật khẩu</label>
                                @error('cf_password')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">Đặt lại mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection