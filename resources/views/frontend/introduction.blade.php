@extends('frontend.master')
@section('frt')
<div class="main-wrapper bg-light">
    <div class="container py-5">
        <header class="text-center mb-5">
            <img src="{{asset("frt")}}/img/logobg.png" alt="E-Learning Logo" class="img-fluid logo mb-4" width="200">
            <h1 class="display-4 fw-bold text-success">Hương Sen Việt Education</h1>
        </header>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="card-title mb-4">Giới thiệu</h2>
                        <p class="card-text">
                            {!!$informations->content!!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Thông tin liên hệ</h4>
                        
                        <div class="contact-item mb-3">
                            <i class="bi bi-telephone-fill text-success me-2"></i>
                            <span>+84 838240571</span>
                        </div>
                        
                        <div class="contact-item mb-3">
                            <i class="bi bi-envelope-fill text-success me-2"></i>
                            <span">huongsenvietedu@gmail.com</span>
                        </div>
                        
                        <div class="contact-item">
                            <i class="bi bi-geo-alt-fill text-success me-2"></i>
                            <span class="mb-0">Số 51 Quang Trung, Hoàng Văn Thụ, Hồng Bàng,  Hải Phòng</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title mb-4">Trang mạng xã hội</h4>
                        <div class="d-flex gap-3 social-links">
                            <a href="https://www.facebook.com/profile.php?id=61573132709227&locale=vi_VN" class="btn btn-primary btn-lg rounded-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="btn btn-info btn-lg rounded-circle"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="btn btn-danger btn-lg rounded-circle"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="btn btn-primary btn-lg rounded-circle"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection