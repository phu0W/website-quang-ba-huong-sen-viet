@extends('frontend.master')
@section('title','Chi tiết khoá học')
@section('frt')
<div class="container py-4">
    <!-- Xếp các nhóm col thành 1 hàng -->
    <div class="row">
        <!-- Mô tả khoá học -->
        <div class="col-lg-8">
            <div class="outercard-section card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $course->name }}</h2>
                    <p class="card-text">
                        {!!$course->description!!}
                    </p>
                    <h4 class="card-title">Khung chương trình</h4>
                </div>
            
                <!-- -------------Danh sách bài học---------- -->
                <div class="container mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 lessons-container">
                            <div class="lessons-wrapper">
                                <div class="lessons-list" id="lessonsList">
                                    
                                    @foreach($chapters as $chapter)
                                        <div class="chapter-section m-3">
                                            <h5><strong>{{ $chapter['title'] }}</strong></h5>

                                            @foreach($chapter['items'] as $item)
                                                @if($item['type'] === 'lesson')
                                                    <div class="lesson-item {{ $item['is_sample'] ? 'free' : 'locked' }}">
                                                        <a href="{{ route('lesson', ['course' => $course->id, 'lesson' => $item['id']]) }}" class="lesson-link">
                                                            <i class="
                                                            @if($isEnrolled) 
                                                                bi bi-play-circle
                                                            @else
                                                                {{$item['is_sample'] ? 'bi bi-play-circle' : 'bi bi-lock'}}
                                                            @endif
                                                            "></i> {{$item['name']}}
                                                        </a>
                                                    <div class="status-text">
                                                        @if($item['is_sample'] && !$isEnrolled)
                                                            <span class="free-text">Miễn phí</span>
                                                        @endif
                                                        @if(in_array($item['id'], $completedLessonIds))
                                                            <span class="complete-text">Hoàn thành</span>
                                                        @endif
                                                        </div>
                                                    </div>
                                                @elseif($item['type'] === 'exam')
                                                    <div class="lesson-item exam-link">
                                                        <a href="{{ route('exam', ['exam' => $item['id']]) }}" class="lesson-link">
                                                            <i class="bi bi-journal-check"></i> {{ $item['name'] }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="outercard-section card border-0 shadow-sm p-4 mb-4">
                <h3>Viết đánh giá</h3>
                <div class="overall-rating text-center mb-4">
                    @if (auth('stu')->check())
                        @if ($isEnrolled)
                            <div id="rateYo"></div>
                            <form action="{{route('course.rating')}}" method="post" class="form-inline" role="form" id="formRating">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="rating" id="rating">
                                    <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{$course->id}}">
                                    <input type="hidden" class="form-control" name="student_id" id="student_id" value="{{auth('stu')->user()->id}}">
                                </div>
                            </form>
                        @else
                            <div id="rateYo1"></div>
                        @endif
                    @else
                        <div id="rateYo1"></div>
                    @endif
                </div>

                <div class="individual-feedback">
                    @if (auth('stu')->check())
                    <form id="" method="POST" action="{{route('course.evaluation')}}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" name="course_id" id="course_id" value="{{$course->id}}">
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" name="student_id" id="student_id" value="{{auth('stu')->user()->id}}">
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="comment" name="comment" value="" placeholder="Viết ý kiến của bạn ở đây..." style="height: 150px" required minlength="10" maxlength="500">{{ $feedBack->comment ?? '' }}</textarea>
                            <label for="message"><i class="bi bi-chat-dots me-2"></i>Viết đánh giá</label>
                            <div class="invalid-feedback">Vui lòng điền để lại đánh giá (10-500 ký tự)</div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-success btn-lg" type="submit">Gửi phản hồi</button>
                        </div>
                    </form>
                    @else
                        <form id="" method="" action="" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="comment" name="comment" value="" placeholder="Viết ý kiến của bạn ở đây..." style="height: 150px" required minlength="10" maxlength="500">{{ $feedBack->comment ?? '' }}</textarea>
                                <label for="message"><i class="bi bi-chat-dots me-2"></i>Viết đánh giá</label>
                                <div class="invalid-feedback">Vui lòng điền để lại đánh giá (10-500 ký tự)</div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="">Gửi phản hồi</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div> 

            <!-- -------------Đánh giá--------------- -->
            <div class="outercard-section card border-0 shadow-sm p-4">
                <h3>Đánh giá nổi bật</h3>
                <div class="overall-rating text-center mb-4">
                    <div id="rateYo2"></div>
                    
                </div>

                <div class="individual-feedback">
                    <div class="feedback-card mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{asset("frt")}}/img/pfp.jpg" alt="Student" class="rounded-circle" width="40" height="40" />
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">12/02/2025</small>
                            </div>
                        </div>
                        <div class="stars small mb-2">★★★★★</div>
                        <p class="mb-0">This course exceeded my expectations. The content is well-structured and the instructor explains complex concepts clearly.</p>
                    </div>

                    <div class="feedback-card mb-3 p-3 border rounded">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{asset("frt")}}/img/pfp.jpg" alt="Student" class="rounded-circle" width="40" height="40" />
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">17/5/2025</small>
                            </div>
                        </div>
                        <div class="stars small mb-2">★★★★★</div>
                        <p class="mb-0">Great practical examples and hands-on projects. Really helped me improve my development skills.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----------------Giỏ hàng & đăng ký------------ -->

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm course-details">
                <img src="{{asset($course->image)}}" class="card-img-top" alt="Course thumbnail" />
                <div class="card-body">
                    <h4>{{ $course->name }}</h4>
                    <label>Giá: <b>{{ number_format($course->price, 0, ',', '.') }} VND</b></label>
                </div>
            </div>
            <!-- Thêm vào giỏ và đăng ký ngay -->
            <a href="{{route('addToCart', $course->id)}}" class="btn btn-warning w-100 mt-4">Thêm vào giỏ</a>
            <a href="{{route('vnpay.buy_now', $course->id)}}" class="btn btn-success w-100 mt-4">Mua ngay</a>
            {{-- <form action="{{route('vnpay.buy_now', $course->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100 mt-4">Mua ngay</a>
            </form> --}}
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css">
    <style>
        #rateYo {
            text-align: center;
            display: inline-block;
        }
        #rateYo1 {
            text-align: center;
            display: inline-block;
        }
        #rateYo2 {
            text-align: center;
            display: inline-block;
        }
    </style>
@endsection
@section('custom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>
    <script>
        var isEnrolled = @json($isEnrolled);
        var isLoggedIn = @json(auth('stu')->check());
        var stuRating = @json($stuRating);
        var ratingAvg = @json($ratingAvg);
        $(function (){
            $("#rateYo").rateYo({
                rating: stuRating,
                starWidth: "25px",
            }).on("rateyo.set", function(e, data) {
                $('#rating').val(data.rating);
                $('#formRating').submit();
            });
        });

        $(function (){
            $("#rateYo1").rateYo({
                rating: 0,
                starWidth: "25px",
            }).on("rateyo.set", function(e, data) {
                if(!isLoggedIn){
                    alert("Bạn chưa đăng nhập, vui lòng đăng nhập để đánh giá !");
                }
                else if(!isEnrolled){
                    alert("Bạn cần phải đăng ký khóa học này trước khi đánh giá !");
                }
            });
        });
        $(function (){
            $("#rateYo2").rateYo({
                rating: ratingAvg,
                starWidth: "25px",
                readOnly: true
            });
        });
    </script>
@endsection