@extends('frontend.master')
@section('frt')
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2>Kết quả tổng quan - {{ auth('stu')->user()->name }}</h2>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Tên khóa học</th>
                                <th>Tổng điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                @php
                                    $totalScore = $courseScores[$course->id] ?? null;
                                @endphp
                                <tr>
                                    <td><a style="text-decoration: none;" class="text-success" href="{{route('overview.exam',$course->id)}}">{{ $course->name }}</a></td>
                                    <td class="{{ is_null($totalScore) ? 'grade-null' : '' }}">
                                        {{ is_null($totalScore) ? '-' : number_format($totalScore, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Bạn chưa đăng ký khóa học nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
