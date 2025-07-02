@extends('frontend.master')
@section('frt')
<div class="container py-5">
    <h2>Báo cáo khóa học: {{ $course->name }}</h2>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Tên bài kiểm tra</th>
                <th>Điểm cao nhất</th>
                <th>Thang điểm</th>
                <th>% hoàn thành</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->chapters as $chapter)
                @foreach($chapter->exams as $exam)
                    @php
                        $attempts = $exam->studentExams;
                        $maxScore = $attempts->max('score');
                        $range = 10; // giả định 10 điểm tối đa
                        $percentage = $maxScore !== null ? ($maxScore / $range * 100) : null;
                    @endphp
                    <tr>
                        <td><a class="text-success" style="text-decoration: none" href="{{route('exam', $exam->id)}}">{{ $exam->name }}</a></td>
                        <td>{{ $maxScore ?? '-' }}</td>
                        <td>0 - {{ $range }}</td>
                        <td>{{ $percentage !== null ? number_format($percentage, 2) . ' %' : '-' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('mycourse') }}" class="btn btn-secondary mt-3">← Quay lại</a>
</div>
@endsection
