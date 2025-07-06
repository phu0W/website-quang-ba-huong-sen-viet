@extends('admin.master')
@section('title','Danh sách bài thi')

@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">BÀI THI</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('exam.create')}}" class="btn btn-success">Thêm mới bài thi</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài thi</th>
                            <th>Mô tả</th>
                            <th>Khóa học</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài thi</th>
                            <th>Mô tả</th>
                            <th>Khóa học</th>
                            <th>Thời gian</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($exams as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{!!$item->description!!}</td>
                                <td>{{ $item->chapter->title . ', ' . $item->chapter->course->name }}</td>
                                <td>{{$item->time}}</td>
                                <td>
                                    <a href="{{route('exam.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('exam.destroy',$item)}}" class="d-inline-block" method="POST">
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


