@extends('admin.master')
@section('title','Danh sách khóa học')

@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">KHÓA HỌC</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('course.create')}}" class="btn btn-success">Thêm mới khóa học</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khóa học</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Môn học</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên khóa học</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Môn học</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($courses as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{!!$item->description!!}</td>
                                <td>{{$item->price}}</td>
                                <td><img src="{{asset($item->image)}}" width="80" alt=""></td>
                                <td>{{$item->subject->name}}</td>
                                <td>
                                    <a href="{{route('course.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('course.destroy',$item)}}" class="d-inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection


