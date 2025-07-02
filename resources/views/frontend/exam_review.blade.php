@extends('frontend.master')
@section('frt')
<div class="container my-5">
    <h2>Review Attempt #{{ $attempt->id }} - {{ $exam->name }}</h2>

    @foreach ($questions as $index => $question)
        <div class="mb-4">
            <h5>Question {{ $index + 1 }}: {!! $question->question_text !!}</h5>
            <ul class="list-group">
                @foreach ($question->answers as $answer)
                    @php
                        $studentAnswer = $question->studentAnswers->firstWhere('answer_id', $answer->id);
                        $isCorrect = $answer->is_correct;
                        $isChosen = $studentAnswer !== null;
                    @endphp

                    <li class="list-group-item
                        {{ $isCorrect ? 'list-group-item-success' : '' }}
                        {{ $isChosen && !$isCorrect ? 'list-group-item-danger' : '' }}">
                        {{ $answer->answer_text }}
                        @if ($isChosen)
                            <span class="badge bg-info text-dark">Your answer</span>
                        @endif
                        @if ($isCorrect)
                            <span class="badge bg-success">Correct</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
