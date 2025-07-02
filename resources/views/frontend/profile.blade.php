@extends('frontend.master')
@section('frt')
<div class="container p-4 my-4">
    <div class="row">
        <!-- Bên trái: Thông tin cá nhân và menu -->
        <div class="col-lg-4">
            <div class="card shadow-sm rounded">
                <div class="card-body text-center">
                    <img src="https://static.vecteezy.com/system/resources/previews/000/439/863/original/vector-users-icon.jpg" class="rounded-circle mb-2" alt="Avatar" width="80" height="80">
                    <h5 class="mb-0">{{$student->name}}</h5>
                    <p class="text-muted small">{{$student->email}}</p>
                </div>
                <hr class="my-2">
                <ul class="list-group list-group-flush px-3 pb-3">
                    <li class="list-group-item border-0 ps-0">
                        <a href="{{route('account.profile')}}" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-user me-2 text-success"></i> Thông tin cá nhân
                        </a>
                    </li>
                    <li class="list-group-item border-0 ps-0">
                        <i class="fas fa-receipt me-2 text-secondary"></i> Lịch sử mua hàng
                    </li>
                    <li class="list-group-item border-0 ps-0">
                        <i class="fas fa-file-invoice me-2 text-secondary"></i> Danh sách xuất hoá đơn
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bên phải: Form thông tin -->
        <div class="col-lg-8">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold text-success">Thông tin cá nhân</h5>
                    <form method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" name="name" value="{{ $student->name }}">
                                @error('name')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" value="2003-08-12">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$student->email}}" readonly>
                                @error('email')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giới tính</label>
                                <select class="form-select" name="gender">
                                    <option value="0" {{$student->gender == 0 ? 'selected' : ''}}>Nữ</option>
                                    <option value="1" {{$student->gender == 1 ? 'selected' : ''}}>Nam</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{$student->phone}}">
                                @error('phone')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nghề nghiệp</label>
                                <input type="text" class="form-control" placeholder="Nghề nghiệp">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{$student->address}}" placeholder="Địa chỉ">
                                @error('address')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection