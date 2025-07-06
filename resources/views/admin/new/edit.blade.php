@extends('admin.master')
@section('title','Cập nhật tin tức')
@section('custom')
    <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        CKEDITOR.replace('editor2',{
            filebrowserImageUploadUrl : "{{ url('admin/uploads-ckeditor?_token='.csrf_token()) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('error'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="content">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Cập nhật tin tức</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route('post.update',$post)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <textarea name="title" id="editor1" rows="10" cols="80" class="form-control" placeholder="">
                        {!!$post->title!!}
                    </textarea>
                    @error('title')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" id="editor2" rows="10" cols="80" class="form-control" placeholder="">
                        {!!$post->content!!}
                    </textarea>
                    @error('content')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control" id="photo" name="photo" placeholder="">
                        @error('photo')
                            <span style="color: red"> {{$message}}</span>
                        @enderror
                        <img src="{{asset($post->image)}}" width="80" alt="">
                    </div>
                    <div class="form-group">
                        <label for="">Là tin tức nổi bật:</label>
                        <div class="radio">
                          <p>
                            <input type="radio" name="is_featured" value="1" {{$post->is_featured ? 'checked' : ''}}>
                            Có
                          </p>
                          <p>
                            <input type="radio" name="is_featured" value="0" {{!$post->is_featured ? 'checked' : ''}}>
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


