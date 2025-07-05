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
                        <a href="{{route('account.payment')}}" style="text-decoration: none; color: inherit;">
                            <i class="fas fa-receipt me-2 text-secondary"></i> Lịch sử mua hàng
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bên phải: Form thông tin -->
        <div class="col-lg-8">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="mb-4 fw-bold text-success">Lịch sử mua hàng</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã GD</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngày thanh toán</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã GD</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngày thanh toán</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($courses as $item)
                                    <tr>
                                        <td>{{ $item->code_vnpay }}</td>
                                        <td>{{ $item->course->id }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $item->time }}</td>
                                        <td>{{ number_format($item->course->price) }} đ</td>
                                        <td>
                                            @if ($item->vnp_response_code == '00')
                                                <span style="color: green">Thành công</span>
                                            @else
                                                <span style="color: red">Thất bại</span>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection