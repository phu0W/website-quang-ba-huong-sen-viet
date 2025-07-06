@extends('admin.master')
@section('title','Cập nhật khóa học')
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
          <h3 class="card-title">Cập nhật khóa học</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('course.update',$course)}}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <input type="hidden" name="id" id="" value="{{$course->id}}">
          <div class="card-body">
            <div class="form-group">
              <label for="">Tên khóa học</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên khóa học" value="{{$course->name}}">
              @error('name')
                <span style="color: red"> {{$message}}</span>
              @enderror
              @error('errors')
                <span style="color: red"> {{$message}}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="">Mô tả</label>
              <textarea name="description" id="editor1" rows="10" cols="80" class="form-control" placeholder="Nhập mô tả">
                {!!$course->description!!}
              </textarea>
            </div>
            <div class="form-group">
                <label for="">Giá khóa học</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá khóa học" value="{{$course->price}}">
                @error('price')
                <span style="color: red"> {{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" class="form-control" id="photo" name="photo" placeholder="Chọn hình ảnh">
                <img src="{{asset($course->image)}}" width="80" alt="">
              </div>
              <div class="form-group">
                <label for="">Chọn môn học</label>
                <select name="subject_id" id="" class="form-control">
                    @foreach ($subjects as $item)
                        <option value="{{$item->id}}" {{$item->id == $course->subject_id ? 'selected' : ""}}>{{$item->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="">Chọn giáo viên</label>
                <select name="teacher_id" id="" class="form-control">
                    @foreach ($teachers as $item)
                        <option value="{{$item->id}}" {{$item->id == $course->teacher_id ? 'selected' : ""}}>{{$item->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="">Là khóa học nổi bật:</label>
                <div class="radio">
                  <p>
                    <input type="radio" name="is_featured" value="1" {{$course->is_featured ? 'checked' : ''}}>
                    Có
                  </p>
                  <p>
                    <input type="radio" name="is_featured" value="0" {{!$course->is_featured ? 'checked' : ''}}>
                    Không
                  </p>
                </div>
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


