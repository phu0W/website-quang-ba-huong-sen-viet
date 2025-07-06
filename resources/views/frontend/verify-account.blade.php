<h3>Hi: {{$account->name}}</h3>
<p>
    Chúng tôi gửi mail này giúp bạn xác nhận đăng ký tài khoản !
</p>
<p>
    <a href="{{route('account.verify', $account->email)}}">Nhấn vào dây để xác nhận đăng ký tài khoản</a>
</p>