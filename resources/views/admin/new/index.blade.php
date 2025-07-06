@extends('admin.master')
@section('title','Danh sách tin tức')

@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">TIN TỨC</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('post.create')}}" class="btn btn-success">Thêm mới tin tức</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($posts as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td>{!!$item->title!!}</td>
                                <td><img src="{{asset($item->image)}}" width="80" alt=""></td>
                                <td>
                                    <a href="{{route('post.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('post.destroy',$item)}}" class="d-inline-block" method="POST">
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


