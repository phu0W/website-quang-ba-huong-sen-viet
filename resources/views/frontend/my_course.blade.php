@extends('frontend.master')

@section('frt')
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Khóa học của tôi</h2>
        <a href="{{ route('overview.result') }}" class="btn btn-success">
            <i class="fas fa-chart-bar me-1"></i> Tổng quan kết quả
        </a>
    </div>

    <div class="row">
        @forelse($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset($course->image) }}" class="card-img-top" alt="Ảnh khóa học">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text text-muted">
                            {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($course->description)), 100) }}
                        </p>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn btn-success">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Bạn chưa đăng ký khóa học nào.</p>
        @endforelse
    </div>
</div>
@endsection
