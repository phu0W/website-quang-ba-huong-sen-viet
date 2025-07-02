<h3>Hi: {{$student->name}}</h3>
<p>
    Chúng tôi gửi mail này giúp bạn lấy lại mật khẩu !
</p>
<p>
    <a href="{{route('account.reset_password', $token)}}">Nhấn vào đây để lấy mật khẩu mới !</a>
</p>