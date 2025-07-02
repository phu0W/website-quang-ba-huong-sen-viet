@extends('admin.master')
@section('title','Thêm tài khoản')
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cập nhật tài khoản</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('user.update',$user)}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" id="" value="{{$user->id}}">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    @error('name')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    @error('email')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                    @error('phone')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Chức vụ</label>
                    <select name="role_id" id="" class="form-control">
                        @foreach ($roles as $item)
                            <option value="{{$item->id}}" {{$item->id == $user->role_id ? 'selected' : ""}}>{{$item->description}}</option>
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


