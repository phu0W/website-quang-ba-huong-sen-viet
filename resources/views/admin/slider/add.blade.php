@extends('admin.master')
@section('title','Thêm slider')
@section('custom')
    <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Thêm slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('slider.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" id="editor1" rows="10" cols="80" class="form-control" placeholder="">
                    
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">Thứ tự hiện</label>
                    <input type="number" min="1" class="form-control" id="order_number" name="order_number" placeholder="">
                    @error('order_number')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" class="form-control" id="photo" name="photo" placeholder="Chọn hình ảnh">
                    @error('photo')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
            </div>
          <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
      </div>
  </div>
</div>
@endsection


