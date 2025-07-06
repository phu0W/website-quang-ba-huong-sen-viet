@extends('admin.master')
@section('title','Danh sách câu hỏi')

@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">CÂU HỎI</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a href="{{route('question.add',$chapter)}}" class="btn btn-success">Thêm mới câu hỏi</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Câu hỏi</th>
                            <th>Loại câu hỏi</th>
                            <th>Thuộc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Câu hỏi</th>
                            <th>Loại câu hỏi</th>
                            <th>Bài thi</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($questions as $item)
                            <tr>
                                <td>{{$stt++}}</td>
                                <td>{!!$item->question_text!!}</td>
                                <td>{{$item->question_type}}</td>
                                <td>{{ $chapter->title . ', ' . $chapter->course->name }}</td>
                                <td>
                                    <a href="{{route('question.edit', $item)}}" class="btn btn-success d-inline-block">Sửa</a>
                                    <form action="{{route('question.destroy',$item)}}" class="d-inline-block" method="POST">
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


