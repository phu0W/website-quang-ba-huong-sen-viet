@extends('admin.master')
@section('title','Cập nhật chương')
@section('custom')
    <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
@section('main-content')
<div class="container-fluid">
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
    @endif
  <div class="content">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('chapter.update', $chapter)}}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="">Tên chương</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$chapter->title}}">
              @error('title')
                <span style="color: red"> {{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Thứ tự chương</label>
              <input type="number" min="1" class="form-control" id="order_number" name="order_number" value="{{$chapter->order_number}}">
              @error('order_number')
                <span class="text-danger"> {{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Chọn khóa học</label>
              <select name="course_id" id="" class="form-control">
                  @foreach ($courses as $item)
                      <option value="{{$item->id}}" {{$item->id == $chapter->course_id ? 'selected' : ""}}>{{$item->name}}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection


