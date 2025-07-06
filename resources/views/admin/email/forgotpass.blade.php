<div style="border: 3px solid green; padding: 15px; background: lightgreen; width: 600px; margin: auto">
    <h3>Xin chào {{$user->name}}</h3>
    <p>
        Bạn muốn lấy lại mật khẩu đúng không?
    </p>
    <p>
        <a href="{{route('admin.getpass', $token)}}" style="display: inline-block; padding: 7px 25px; color: #fff; background: darkblue">Click vào đây để cập nhật mật khẩu mới</a>
    </p>
</div>