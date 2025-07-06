@extends('admin.master')
@section('title','Danh sách môn học')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm môn học</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('subject.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="">Tên môn học</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên môn học">
              @error('name')
                <span style="color: red"> {{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Mô tả</label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả">
            </div>
            <div class="form-group">
              <label for="">Hình ảnh</label>
              <input type="file" class="form-control" id="photo" name="photo" placeholder="Chọn hình ảnh">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Thêm</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection


