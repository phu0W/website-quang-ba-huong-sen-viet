@extends('frontend.master')
@section('title','Danh sách khoá học')
@section('frt')
<section class="courses-section pb-5">
    <div class="container mt-4">
        <div class="text-center">
            <h1>Các khoá học {{ $subject->name }}</h1>
        </div>
        <hr class="my-4" />
        <div class="row g-4">
            @foreach($courses as $course)
            <div class="col-md-6 col-lg-4">
                    <div class="card h-100 rounded">
                        <img src="{{asset($course->image)}}" class="card-img-top" alt="Course" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($course->description)), 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ number_format($course->price, 0, ',', '.') }} VND</span>
                                <a href="{{ route('course.detail', $course->id) }}" class="btn btn-outline-success">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection