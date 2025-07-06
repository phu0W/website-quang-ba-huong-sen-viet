@extends('frontend.master')
@section('frt')
<div class="container-fluid py-5">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 mb-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-geo-alt-fill me-2 text-success"></i>Chọn cơ sở bạn muốn xem</h5>
                        
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <button class="btn btn-outline-success active" onclick="showMap('cs1', this)">Cơ sở 1 - Lê Đại Hành</button>
                            <button class="btn btn-outline-success" onclick="showMap('cs2', this)">Cơ sở 2 - Quang Trung</button>
                        </div>

                        <div class="ratio ratio-4x3 rounded">
                            <iframe 
                                id="mapFrame"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1705.0162065163208!2d106.68251277747333!3d20.862225005291915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7af3dd8f8b41%3A0xf62b4f2fc3037dc1!2zMTYgUC4gTMOqIMSQ4bqhaSBIw6BuaCwgTWluaCBLaGFpLCBI4buTbmcgQsOgbmcsIEjhuqNpIFBow7JuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1747727981165!5m2!1svi!2s" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <div class="text-end mt-2">
                            <a id="mapLink" href="https://www.google.com/maps?q=16+Lê+Đại+Hành,+Hồng+Bàng,+Hải+Phòng" target="_blank" class="btn btn-sm btn-outline-success">
                                Mở bản đồ lớn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <img src="img/logobg.png" alt="" class="mb-4 rounded-circle" width="80">
                            <h2 class="fw-bold">Liên hệ với chúng tôi</h2>
                            <p class="text-muted">Chúng tôi luôn lắng nghe phản hồi từ bạn. Vui lòng điền thông tin bên dưới:</p>
                        </div>
                        <form id="contactForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nguyễn Văn A" required minlength="2" maxlength="50">
                                <label for="name"><i class="bi bi-person me-2"></i>Họ tên</label>
                                <div class="invalid-feedback">Vui lòng điền họ tên (2-50 ký tự)</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="" required>
                                <label for="phone"><i class="bi bi-telephone me-2"></i>Số điện thoại</label>
                                <div class="invalid-feedback">Vui lòng điền số điện thoại hợp lệ</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required maxlength="100">
                                <label for="email"><i class="bi bi-envelope me-2"></i>Địa chỉ Email</label>
                                <div class="invalid-feedback">Vui lòng điền email hợp lệ</div>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="address" name="address" placeholder="123 Tên Đường, Thành Phố" maxlength="200">
                                <label for="address"><i class="bi bi-geo-alt me-2"></i>Địa chỉ (Không bắt buộc)</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="message" name="message" placeholder="Viết ý kiến của bạn ở đây..." style="height: 150px" required minlength="10" maxlength="500"></textarea>
                                <label for="message"><i class="bi bi-chat-dots me-2"></i>Tin nhắn của bạn</label>
                                <div class="invalid-feedback">Vui lòng điền để lại tin nhắn (10-500 ký tự)</div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">Gửi phản hồi</button>
                            </div>
                        </form>
                        <div class="mt-5">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <i class="bi bi-geo-alt-fill fs-2 text-success mb-2"></i>
                                    <p class="mb-0">51 Quang Trung</p>
                                    <p class="text-muted">Hồng Bàng, Hải Phòng</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="bi bi-telephone-fill fs-2 text-success mb-2"></i>
                                    <p class="mb-0">+84 838240571</p>
                                    <p class="text-muted">Mon-Fri 9am-6pm</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="bi bi-envelope-fill fs-2 text-success mb-2"></i>
                                    <p class="mb-0 text-nowrap">huongsenvietedu@gmail.com</p>
                                    <p class="text-muted">Hỗ trợ trực tuyến</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom')
    <script>
        const mapData = {
            cs1: {
                url: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1705.0162065163208!2d106.68251277747333!3d20.862225005291915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7af3dd8f8b41%3A0xf62b4f2fc3037dc1!2zMTYgUC4gTMOqIMSQ4bqhaSBIw6BuaCwgTWluaCBLaGFpLCBI4buTbmcgQsOgbmcsIEjhuqNpIFBow7JuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1747727981165!5m2!1svi!2s",
                link: "https://www.google.com/maps?q=16+Lê+Đại+Hành,+Hồng+Bàng,+Hải+Phòng"
            },
            cs2: {
                url: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.386406835184!2d106.67732507502635!3d20.85646998075006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7a8b25409a63%3A0x45b1a70f5c98ac08!2zNTEgUC4gUXVhbmcgVHJ1bmcsIFF1YW5nIFRydW5nLCBI4buTbmcgQsOgbmcsIEjhuqNpIFBow7JuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1747729450669!5m2!1svi!2s",
                link: "https://www.google.com/maps?q=51+Quang+Trung,+Hồng+Bàng,+Hải+Phòng"
            }
        };

        function showMap(csKey, button) {
            const iframe = document.getElementById('mapFrame');
            const mapLink = document.getElementById('mapLink');

            iframe.src = mapData[csKey].url;
            mapLink.href = mapData[csKey].link;

            // Cập nhật trạng thái nút
            document.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        }
    </script>
@endsection