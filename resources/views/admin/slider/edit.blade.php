@extends('admin.master')
@section('title','Cập nhật slider')
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
          <h3 class="card-title">Cập nhật slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('slider.update',$slider)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" id="editor1" rows="10" cols="80" class="form-control" placeholder="">
                  {!!$slider->description!!}  
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">Thứ tự hiện</label>
                    <input type="number" min="1" class="form-control" id="order_number" name="order_number" placeholder="" value="{{$slider->order_number}}">
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
                    <img src="{{asset($slider->image)}}" alt="" width="120">
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


