@extends('frontend.master')
@section('frt')
{{-- @php
    use Illuminate\Support\Str;
@endphp --}}
<section class="mymaincontent">
    <!--slider-->
    <div id="heroCarousel" class="carousel slide home-carousel mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $item)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{asset($item->image)}}" loading="lazy" class="d-block w-100" alt="Education">
                <div class="carousel-caption">
                    {!!$item->description!!}
                    <a href="{{ route('home.index') }}#intro-section" class="btn btn-success btn-lg">Về chúng tôi</a>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>
<!--------------Section giới thiệu------------------>
<section id="intro-section" class="py-5 bg-image">
    <div class="container">
        <div class="row align-items-center">
            <!-- Hình ảnh hiển thị trước trên mobile -->
            <div class="col-lg-6 order-1 order-lg-2">
                <img src="{{asset("frt")}}/img/aboutus.jpg" class="img-fluid rounded w-100" alt="">
            </div>
            <div class="col-lg-6 order-2 order-lg-1">
                <h2>Về Hương Sen Việt</h2>
                <p class="lead">Chúng tôi tin rằng giáo dục không chỉ là quá trình tiếp thu kiến thức, mà còn là hành trình khám phá tiềm năng và bồi đắp nhân cách.</p>
                <p>Với sứ mệnh <span class="fw-bold">"Kiến tạo nền giáo dục nhân văn, nuôi dưỡng tri thức và tâm hồn thế hệ trẻ"</span>, Hương Sen Việt cam kết mang đến những chương trình học tập chất lượng cao, giúp học sinh phát triển toàn diện, từ tư duy đến đạo đức, từ tri thức đến kỹ năng sống.</p>
                <a href="{{ route('introduction') }}" class="btn btn-success mt-3">Tìm hiểu thêm</a>
            </div>
        </div>
    </div>
</section>
<!------------------------- Sứ mệnh ----------------------->
<section id="values" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Giá trị cốt lõi</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="value-card text-center">
                    <i class="bi bi-lightbulb fs-1"></i>
                    <h4 class="mt-3">Sáng tạo</h4>
                    <p>Luôn đổi mới, không ngừng cải tiến phương pháp giảng dạy để mang lại hiệu quả tối ưu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card text-center">
                    <i class="bi bi-people fs-1"></i>
                    <h4 class="mt-3">Hợp tác</h4>
                    <p>Đồng hành cùng phụ huynh, học sinh để xây dựng một nền giáo dục bền vững và nhân văn.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="value-card text-center">
                    <i class="bi bi-heart fs-1"></i>
                    <h4 class="mt-3">Tận tâm</h4>
                    <p>Chúng tôi đặt cả trái tim vào từng bài giảng, từng học viên, từng giấc mơ.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------------------- News section------------------- -->
<div class="container py-5">
    <div class="row">
        <div class="text-center">
            <h2 class="mb-5">Tin tức nổi bật</h2>
        </div>
        <div class="col-lg-8 mb-4">
            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    @foreach($featured as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="card news-card rounded">
                            <img src="{{asset($item->image)}}" loading="lazy" alt="Technology News">
                            <div class="card-img-overlay">
                                {{-- <span class="badge bg-primary mb-2">Danh mục 1</span> --}}
                                <a href="news_detail.html" class="card-title">{!!$item->title!!}</a>
                                {{-- <p class="card-text">Exploring how artificial intelligence is reshaping our digital landscape</p> --}}
                                <div class="meta-info">
                                    <span class="date">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('F d, Y') }}</span>
                                    <a href="{{ route('new') }}" class="btn btn-light btn-sm">Đọc tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                @foreach($featured as $index => $item)
                <div class="col-12 mb-4">
                    <div class="card small-news-card rounded">
                        <div class="row g-0">
                            <div class="col-4">
                                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0" loading="lazy" class="img-fluid" alt="Sports News">
                            </div>
                            <div class="col-8 list1">
                                <div class="card-body">
                                    <a href="{{ route('new') }}" class="card-title">
                                    Đây là tiêu đề
                                    </a>
                                    <p class="card-text"><small class="text-muted">Tháng Ba 12, 2025</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<section class="courses-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Khoá học nổi bật</h2>
        <div class="row align-items-center">
            <!-- Nút Previous -->
            <div class="col-auto">
                <button class="btn btn-outline-dark" type="button" data-bs-target="#courseCarousel" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>
        
            <!-- Carousel -->
            <div class="col">
                <div id="courseCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($featuredCourses->chunk(3) as $chunkIndex => $chunk)
                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                <div class="row g-4">
                                    @foreach($chunk as $course)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card h-100 rounded">
                                                <img src="{{asset($course->image)}}" loading="lazy" class="card-img-top" alt="{{ $course->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $course->name }}</h5>
                                                    <p class="card-text">
                                                        {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($course->description)), 100) }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="fw-bold">{{ number_format($course->price * 1000, 0, ',', '.') }} VND</span>
                                                        <a href="{{ route('course.detail', ['course_id' => $course->id]) }}" class="btn btn-outline-success">Xem chi tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        
            <!-- Nút Next -->
            <div class="col-auto">
                <button class="btn btn-outline-dark" type="button" data-bs-target="#courseCarousel" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>
<section id="category-section" class="category-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Danh mục khoá học</h2>
        
        <div class="row g-4">
            @foreach($subjects as $subject)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="category-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{ asset($subject->image) }}" loading="lazy" class="rounded-circle me-3" alt="{{ $subject->name }}">
                            <a href="{{ route('course.list', ['subject_id' => $subject->id]) }}" class="category-title mb-0">
                                {{ $subject->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="highlighted-feedback-section py-5 bg-success">
    <div class="container">
        <h2 class="text-center mb-5 text-light">Đánh giá từ học viên</h2>
        <div id="feedbackCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">Sarah Johnson</h6>
                                        <small class="text-muted">12/02/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★★</div>
                                <p class="mb-0">This course exceeded my expectations. The content is well-structured and the instructor explains complex concepts clearly.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">Michael Chen</h6>
                                        <small class="text-muted">17/5/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★★</div>
                                <p class="mb-0">Great practical examples and hands-on projects. Really helped me improve my development skills.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">Emily Davis</h6>
                                        <small class="text-muted">05/03/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★☆</div>
                                <p class="mb-0">Good course! Some parts could be more detailed, but overall a great experience.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">David Smith</h6>
                                        <small class="text-muted">22/01/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★★</div>
                                <p class="mb-0">Very comprehensive and well-explained lessons. Helped me a lot in my studies!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">John Williams</h6>
                                        <small class="text-muted">10/02/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★★</div>
                                <p class="mb-0">Excellent course, really engaging and practical. Highly recommend!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feedback-card mb-3 p-3 border rounded">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <img src="{{asset("frt")}}/img/pfp.jpg" loading="lazy" alt="Student" class="rounded-circle" width="40" height="40">
                                    <div>
                                        <h6 class="mb-0">Anna Lee</h6>
                                        <small class="text-muted">02/04/2025</small>
                                    </div>
                                </div>
                                <div class="stars small mb-2 text-warning">★★★★☆</div>
                                <p class="mb-0">Great material, but would love more real-world examples. Overall a good course.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Điều khiển slider -->
            <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endsection
