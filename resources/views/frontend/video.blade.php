@extends('frontend.master')
@section('custom')
<script async src="https://www.youtube.com/iframe_api"></script>
<script>
    const allowedPercent = {{ $lesson->percent }};
    const isEnrolled = {!! json_encode($isEnrolled) !!};
    const isCompletedCurrent = {!! json_encode($isCompletedCurrent) !!};
    @if ($nextLessonUrl)
        const nextLessonUrl = "{{ $nextLessonUrl }}";
    @else
        const nextLessonUrl = null;
    @endif
</script>
<script>
    var player;
    let hasReported = false;
    let interval = null;

    // Hàm khởi tạo player khi API đã sẵn sàng
    function onYouTubeIframeAPIReady() {
        console.log("YouTube API đã sẵn sàng, đang tạo player...");
        player = new YT.Player('player', {
            videoId: '{{ $lesson->file_id }}',
            playerVars: {
                'enablejsapi': 1,
                'origin': window.location.origin,
                controls: isCompletedCurrent ? 1 : 0, 
                disablekb: isCompletedCurrent ? 0 : 1 
            },
            events: {
                'onStateChange': onPlayerStateChange
            }
        });

    }

    // Hàm xử lý khi trạng thái video thay đổi
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {

            // Kiểm tra nếu người học tua vượt quá 2% ngay từ đầu
            const currentTime = player.getCurrentTime();
            const duration = player.getDuration();
            const percent = (currentTime / duration) * 100;

            if (percent > allowedPercent && !hasReported && isEnrolled && !isCompletedCurrent) {
                reportProgress();
                return;
            }

            // Nếu chưa có interval nào thì bắt đầu kiểm tra định kỳ
            if (!interval) {
                interval = setInterval(() => {
                    const currentTime = player.getCurrentTime();
                    const duration = player.getDuration();
                    const percent = (currentTime / duration) * 100;

                    if (percent > allowedPercent && !hasReported && isEnrolled && !isCompletedCurrent) {
                        reportProgress();
                    }
                }, 1000);
            }

        } else if (event.data == YT.PlayerState.ENDED && isEnrolled) {
            clearInterval(interval);
            interval = null;
            if (nextLessonUrl) {
                window.location.href = nextLessonUrl;
            } else {
                alert("Đã hết bài học.");
            }
        } else {
            // Nếu video tạm dừng hoặc dừng hẳn thì ngừng kiểm tra
            clearInterval(interval);
            interval = null;
        }
    }

    // Hàm gửi tiến độ học lên server
    function reportProgress() {
        hasReported = true;
        clearInterval(interval);
        interval = null;

        fetch('/api/lesson/progress', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                lesson_id: {{ $lesson->id }},
                student_id: {{ auth('stu')->id() }}
            })
        })
        .then(response => {
            if (response.ok) {
                alert("Tiến độ học của bạn đã được ghi nhận!");
            } else {
                alert("Có lỗi xảy ra khi ghi nhận tiến độ.");
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert("Không thể kết nối tới server.");
        });
    }
</script>
@endsection
@section('frt')
<div class="container mb-5">
    <div class="row video-container">
        <div class="col-md-8">
            <!-- Video Player -->
            <div class="ratio ratio-16x9 video-wrapper" id="video-container">
                {{-- <iframe id="player" width="100%" height="400" src="https://www.youtube.com/embed/{{ $lesson->file_id }}?enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media"
                    allowfullscreen></iframe> --}}
                <div id="player"></div>
            </div>
    
            <!-- Video Title -->
            <h2 class="video-title mt-3">{{ $lesson->name }}</h2>
            @if ($isEnrolled)
                <h5>Thời lượng đạt: {{$lesson->percent}} %</h5>
            @endif
        </div>
    
        <div class="col-md-4">
            <!-- Course Name -->
            <h5 class="course-name">{{ $course->name }}</h5>
    
            <!-- Lesson List Wrapper with Scrollbar -->
            <div class="lessons-wrapper">
                <div class="lesson-list">
                    <div class="list-group">
                        @foreach($navigationChapters as $chapter)
                            <div class="fw-bold m-2">{{ $chapter['title'] }}</div>
                            @foreach($chapter['items'] as $item)
                                @php
                                    $isActive = ($item['type'] === 'lesson' && $item['id'] == $currentLessonId);
                                    $url = $item['type'] === 'lesson'
                                        ? route('lesson', ['course' => $course->id, 'lesson' => $item['id']])
                                        : route('exam', ['course' => $course->id, 'exam' => $item['id']]);
                                @endphp
                                <a href="{{ $url }}" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between {{ $isActive ? 'active' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                    {{-- Icon --}}
                                         @if($item['type'] === 'lesson')
                                            <i class="
                                            @if($isEnrolled)
                                            bi bi-play-circle
                                            @else
                                            {{ $item['model']->is_sample ? 'bi bi-play-circle' : 'bi bi-lock' }}
                                            @endif
                                            "></i>
                                            @else
                                            <i class="bi bi-journal-check"></i>
                                            @endif
                                    {{-- Tên bài học / bài kiểm tra --}}
                                        {{ $item['model']->name }}
                                    </div>
                                    {{-- Trạng thái --}}
                                    <div class="status-text">
                                    {{-- Miễn phí --}}
                                        @if($item['type'] === 'lesson' && $item['model']->is_sample && !$isEnrolled)
                                            <span class="free-text">Miễn phí</span>
                                        @endif
                                        {{-- Hoàn thành --}}
                                        @if($item['type'] === 'lesson' && in_array($item['id'], $completedLessonIds))
                                            <span class="complete-text">Hoàn thành</span>
                                        @endif
                                        @if($item['type'] === 'exam' && $item['model']->is_sample && !$isEnrolled)
                                            <span class="free-text">Miễn phí</span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection