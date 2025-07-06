@extends('frontend.master')
@section('frt')
    <div class="container my-5">
        <div class="row g-4">
        <!-- Giỏ hàng -->
        <div class="col-lg-8">
            <div class="card p-4">
            <h5 class="mb-3 fw-bold">Giỏ hàng</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                    <th scope="col" style="width: 10%">STT</th>
                    <th scope="col" style="width: 55%">Sản phẩm</th>
                    <th scope="col" style="width: 15%">Đơn giá</th>
                    <th scope="col" style="width: 20%">Thành tiền</th>
                    <th style="width: 5%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tong = 0;
                    @endphp
                    @if ($cart)
                        @foreach ($cart->cartDetails as $key => $cartDetail)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>
                                    <span>{{$cartDetail->course->name}}</span>
                                </td>
                                <td>
                                    <span class="price-new">
                                        @php
                                            echo number_format(intval($cartDetail->course->price));
                                        @endphp
                                    </span>
                                </td>
                                <td class="price-new">
                                    @php
                                        $thanhtien = intval($cartDetail->course->price);
                                        echo number_format($thanhtien);
                                        $tong += $thanhtien;
                                    @endphp
                                </td>
                                <td><i class="bi bi-trash" data-bs-toggle="modal" data-bs-target="#modalDelete" data-cartdetail-id="{{ $cartDetail->id }}"></i></td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">Chưa có sản phẩm nào được thêm vào giỏ hàng</td></tr>
                    @endif
                </tbody>
                </table>
            </div>
            <div class="text-end mt-3 fw-bold fs-5">Tổng: <span class="price-new">
                {{number_format($tong)}}
            </span></div>
            </div>
        </div>
    
        <!-- Tổng hợp đơn -->
        <div class="col-lg-4">
            <div class="card p-4">
            <h6 class="fw-bold text-primary">Tổng hợp</h6>
            <div class="d-flex justify-content-between mt-3">
                <span>Thành tiền</span>
                <span>{{number_format($tong)}} VNĐ</span>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span>Phí vận chuyển</span>
                <span>-</span>
            </div>
            <div class="d-flex justify-content-between mt-2 mb-3">
                <span>Thuế</span>
                <span>-</span>
            </div>
            <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                <span>Tổng</span>
                <span class="price-new">{{number_format($tong)}} VNĐ</span>
            </div>
            <form action="{{route('vnpay.payment')}}" method="post">
                @csrf
                <button type="submit" name="redirect" class="btn btn-orange w-100 mt-4 py-2 fw-bold">Mua hàng</button>
                <input type="hidden" name="total_vnpay" id="" value="{{$tong}}">
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLabel">Thông báo </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('deleteCart') }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" value="" id="inputCartDetailId" name="cartDetailId">
                <div class="modal-body">
                    <span class="text-danger">Bạn có muốn xóa không ?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xác nhận xóa</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
@section('custom')
   <script>
        var modalDelete = document.getElementById('modalDelete')
        modalDelete.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var cartDetailId = button.getAttribute('data-cartdetail-id')
        document.getElementById("inputCartDetailId").value = cartDetailId
        })
    </script> 
@endsection
