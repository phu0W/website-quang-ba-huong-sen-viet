@extends('admin.master')
@section('title','Cập nhật thông tin')
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
            <form method="POST" action="{{route('infor.update',$infor)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Số điện thoại 1</label>
                            <input type="text" class="form-control" id="phone1" name="phone1" placeholder="" value="{{$infor->phone1}}">
                        </div>
                        <div class="col-md-6">
                            <label for="">Số điện thoại 2</label>
                            <input type="text" class="form-control" id="phone2" name="phone2" placeholder="" value="{{$infor->phone2}}">
                        </div>
                    </div>
                    
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Facebook</label>
                                <input type="text" class="form-control" id="fb" name="fb" placeholder="" value="{{$infor->fb}}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{$infor->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Địa chỉ 1</label>
                                <input type="text" class="form-control" id="address1" name="address1" placeholder="" value="{{$infor->address1}}">
                            </div>
                            <div class="col-md-6">
                                <label for="">Địa chỉ 2</label>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="" value="{{$infor->address2}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Logo</label>
                        <input type="file" class="form-control" id="photo" name="photo" placeholder="Chọn hình ảnh">
                        <img src="{{asset($infor->logo)}}" width="80" alt="" class="mt-3">
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung giới thiệu</label>
                        <textarea name="content" id="editor1" rows="10" cols="80" class="form-control" placeholder="">
                            {!!$infor->content!!}
                        </textarea>
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


