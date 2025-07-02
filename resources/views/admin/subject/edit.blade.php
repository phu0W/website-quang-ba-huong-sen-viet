@extends('admin.master')
@section('title','Danh sách môn học')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cập nhật môn học</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('subject.update',$subject)}}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <input type="hidden" name="id" id="" value="{{$subject->id}}">
          <div class="card-body">
            <div class="form-group">
              <label for="">Tên môn học</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên môn học" value="{{old('name') ? old('name') : $subject->name}}">
              @error('name')
                <span style="color: red"> {{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Mô tả</label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" value="{{$subject->description}}">
            </div>
            <div class="form-group">
              <label for="">Hình ảnh</label>
              <input type="file" class="form-control" id="photo" name="photo" placeholder="Chọn hình ảnh">
              <img src="{{asset($subject->image)}}" width="80" alt="">
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


