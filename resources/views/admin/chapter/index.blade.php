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
    <h1 class="h3 mb-2 text-gray-800">DANH SÁCH CHƯƠNG</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('chapter.create')}}" class="btn btn-success">Thêm mới chương</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên chương</th>
                            <th>Khóa học</th>
                            <th>Thứ tự</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên chương</th>
                            <th>Khóa học</th>
                            <th>Thứ tự</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($chapters as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->course->name}}</td>
                                <td>{{$item->order_number}}</td>
                                <td>
                                    <a href="{{route('chapter.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('chapter.destroy',$item)}}" class="d-inline-block" method="POST">
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


