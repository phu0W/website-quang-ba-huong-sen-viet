<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'HƯƠNG SEN VIỆT - CHẮP CÁNH TRI THỨC, VƯƠN TỚI THÀNH CÔNG')</title>
        <link rel="stylesheet" href="{{asset("frt")}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset("frt")}}/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
        @yield('css')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand fw-bold" href="{{route('home.index')}}">
                <img src="{{asset("frt")}}/img/logobg.png" class="img-fluid" alt="Logo" width="50">
                <span class="ms-2">HƯƠNG SEN VIỆT</span>
                </a>
                <!-- Toggle Button -->
                <button 
                    class="navbar-toggler" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarScroll" 
                    aria-controls="navbarScroll" 
                    aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav m-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('home.index')}}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('introduction')}}">Giới thiệu</a>
                        </li>
                        <!-- Dropdown: Khóa học -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Khóa học
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($subs as $subject)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('course.list', ['subject_id' => $subject->id]) }}">
                                            {{ $subject->name }}
                                        </a>
                                    </li>
                                @endforeach
                                @if (auth('stu')->check())
                                <li><a class="dropdown-item" href="{{route('mycourse')}}" style="background-color: ">Khóa học của tôi</a></li>
                                @endif
                            </ul>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('new')}}">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact')}}">Liên hệ</a>
                        </li>
                    </ul>
                    <!-- Đăng nhập/đăng ký -->
                    <form class="d-flex" role="search">
                        <div class="d-flex gap-2">
                            @if (auth('stu')->check())
                                <a href="{{route('viewCart')}}" class="nav-link my-auto fs-4"><i class="fas fa-cart-plus"></i></a>
                                <div class="dropdown my-auto">
                                    <a class="nav-link fs-4 d-flex align-items-center gap-2" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle"></i>
                                        <span class="text-capitalize fs-6">{{ auth('stu')->user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                        <li><a class="dropdown-item" href="{{ route('account.profile') }}">Thông tin cá nhân</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalChangePass">Thay đổi mật khẩu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('account.logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </div>
                                
                            @else
                                <a href="{{route('account.login')}}" class="btn btn-outline-success btn0">Đăng nhập</a>
                                <a href="{{route('account.register')}}" class="btn btn-success btn0">Đăng ký</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        @yield('frt')
        <footer class="bg-dark text-light py-5">
            <div class="container">
                <div class="row g-4 footer">
                    <!-- Địa chỉ -->
                    <div class="col-lg-4">
                        <h5 class="d-flex align-items-center"><i class="bi bi-geo-alt-fill me-2"></i> ĐỊA CHỈ</h5>
                        <div class="mt-4">
                            <h6>CƠ SỞ 1</h6>
                            <p class="text-muted">{{$informations->address1}}</p>
                        </div>
                        <div class="mt-4">
                            <h6>CƠ SỞ 2</h6>
                            <p class="text-muted">{{$informations->address2}}</p>
                        </div>
                    </div>
                    <!-- Liên hệ và Email -->
                    <div class="col-lg-4">
                        <div>
                            <h5 class="d-flex align-items-center"><i class="bi bi-telephone-fill me-2"></i> LIÊN HỆ VỚI CHÚNG TÔI</h5>
                            <p class="text-muted mt-4">Hotline: {{$informations->phone1}} - {{$informations->phone2}}</p>
                        </div>
                        <div class="mt-5">
                            <h5 class="d-flex align-items-center"><i class="bi bi-envelope-fill me-2"></i> ĐỊA CHỈ EMAIL</h5>
                            <p class="text-muted mt-3">{{$informations->email}}</p>
                        </div>
                    </div>
                    <!-- Truy cập nhanh -->
                    <div class="col-lg-4">
                        <h5 class="d-flex align-items-center"><i class="bi bi-link-45deg me-2"></i> TRUY CẬP NHANH</h5>
                        <ul class="list-unstyled mt-3">
                            <li><a href="{{ route('introduction') }}" class="text-light">Giới thiệu</a></li>
                            <li><a href="{{ route('home.index') }}#category-section" class="text-light">Khoá học</a></li>
                            <li><a href="{{ route('contact') }}" class="text-light">Liên hệ</a></li>
                            <li><a href="https://www.facebook.com/profile.php?id=61573132709227&locale=vi_VN" class="text-light" target="_blank">Fanpage Facebook</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="text-center">
                    <p class="mb-0">© 2025 Huong Sen Viet Edu. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="modalChangePass" tabindex="-1" aria-labelledby="modalChangePassLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalChangePassLabel">
                        <i class="bi bi-shield-lock-fill me-2"></i>Thay đổi mật khẩu
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('account.change_password') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Mật khẩu cũ
                                </label>
                                <input type="password" class="form-control" id="" name="old_password" placeholder="Nhập mật khẩu cũ" required maxlength="100">
                                @error('old_password')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Mật khẩu mới
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới" required>
                                @error('password')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Xác nhận mật khẩu mới
                                </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
                                @error('confirm_password')
                                    <span style="color: red"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Đóng
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i>Xác nhận
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($errors->has('old_password') || $errors->has('password') || $errors->has('confirm_password'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var modal = new bootstrap.Modal(document.getElementById('modalChangePass'));
                    modal.show();
                });
            </script>
        @endif

        <script>
            var modalChangePass = document.getElementById('modalChangePass')
            modalChangePass.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            })
        </script> 
        <script src="{{asset("frt")}}/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
        @if(Session::has('success'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: "{{ Session::get('success') }}",
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-center',
            })
        </script>
        @endif
        @if(Session::has('error'))
        <script>
            $.toast({
                heading: 'Thông báo',
                text: "{{ Session::get('error') }}",
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-center',
            })
        </script>
        @endif
        @yield('custom')
    </body>
</html>