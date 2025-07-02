@extends('admin.master')
@section('title','Danh sách bài học')

@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">BÀI HỌC</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('lesson.create')}}" class="btn btn-success">Thêm mới bài học</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài học</th>
                            <th>Bài số</th>
                            <th>Thuộc chương</th>
                            <th>Khoá học</th>
                            <th>Bài mẫu</th>
                            <th>Đường dẫn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài học</th>
                            <th>Bài số</th>
                            <th>Thuộc chương</th>
                            <th>Khoá học</th>
                            <th>Bài mẫu</th>
                            <th>Đường dẫn</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($lessons as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->order_number}}</td>
                                <td>{{$item->chapter->title}}</td>
                                <td>{{$item->course->name}}</td>
                                <td>{{$item->is_sample == 1 ? "Có" : "Không"}}</td>
                                <td>{{$item->file_id}}</td>
                                <td>
                                    <a href="{{route('lesson.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('lesson.destroy',$item)}}" class="d-inline-block" method="POST">
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


