@extends('frontend.master')
@section('frt')
    <div class="container my-5 text-center">
        <h1>{{$exam->name}}</h1>

        <div class="mt-4">
            <p><strong>Attempts allowed:</strong> {{$exam->max_attempts}}</p>
            <p>Time limit: {{$exam->time}} mins</p>
            <p>Grading method: Highest grade</p>
        </div>

        <h4 class="summary-title mt-5">Summary of your previous attempts</h4>

        <div class="table-responsive mt-3">
            <table class="table table-bordered table-striped align-middle">
            <thead class="table-success">
                <tr>
                <th>Attempt</th>
                <th>State</th>
                <th>Grade / 10.00</th>
                <th>Review</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attempts as $attempt)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>
                            @if($attempt->submitted_at)
                                Finished<br>
                                <small class="text-muted">Submitted {{ $attempt->submitted_at->format('H:i d/m/Y') }}</small>
                            @else
                                In progress<br>
                                <small class="text-muted">Started {{ $attempt->start_time->format('H:i d/m/Y') }}</small>
                            @endif
                        </td>
                        <td>{{number_format($attempt->score, 2)}}</td>
                        <td>
                            @if($attempt->submitted_at)
                                <a href="{{ route('exam.review', $attempt->id) }}">Review</a>
                            @else
                                <span class="text-muted">In progress</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <div class="final-grade text-center mt-4">
            Your final grade for this quiz is <strong>{{ $attempts->count() > 0 ? number_format($highestScore, 2) : '' }}/10.00</strong>.
        </div>

        <div class="d-flex justify-content-center mt-3 gap-3">
            <a href="{{ route('course.detail', $exam->chapter->course->id) }}" class="btn btn-success">Back to the course</a>
            @if($lastAttempt && is_null($lastAttempt->submitted_at) && now()->lessThanOrEqualTo($lastAttempt->end_time))
                <a href="{{ route('exam.detail', $exam->id) }}" class="btn btn-warning">Continue last attempt</a>
            @elseif($attempts->count() < $exam->max_attempts)
                <a href="{{ route('exam.detail', $exam->id) }}" class="btn btn-primary">Attempt</a>
            @else
                <p class="text-muted my-auto">No more attempts are allowed</p>
            @endif
        </div>
    </div>
@endsection