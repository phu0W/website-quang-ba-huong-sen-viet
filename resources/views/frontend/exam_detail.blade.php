<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang bài thi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .question-number {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s;
        }
        .question-number:hover {
            background-color: #e9ecef;
        }
        .question-number.active {
            background-color: #9da0a5;
            color: white;
        }
        .question-number.answered {
            background-color: #198754;
            color: white;
        }
        .question-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border: 1px solid #dee2e6;
        }
        .question-container.active {
            border: 2px solid #039a35;
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.1);
        }
        .question-type-badge {
            font-size: 0.8rem;
            padding: 3px 10px;
            border-radius: 12px;
            background-color: #e9ecef;
        }
        #questionList {
            overflow-y: auto;
        }
        .choice-option {
            cursor: pointer;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px 15px;
            margin-bottom: 8px;
            transition: all 0.2s;
        }
        .choice-option:hover {
            background-color: #f8f9fa;
        }
        .choice-option.selected {
            background-color: #cfe2ff;
            border-color: #039a35;
        }
        .main-content {
            height: calc(100vh - 60px);
        }
        #questionsContent {
            height: 100%;
            overflow-y: auto;
            padding-right: 10px;
            padding-bottom: 60px;
            margin-left: 35%;
            padding-top: 60px;
        }
        .page-indicator {
            margin-bottom: 15px;
            justify-content: center;
            text-align: center;
        }
        .pagination {
            justify-content: center;
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            padding: 15px;
            top: 80px; 
            height: calc(100vh - 150px); 
            position: fixed; 
            left: 0;
        }
    </style>
</head>
<body>
    <header class="bg-success text-white py-3">
        <div class="container">
            <h1 class="h4 mb-0">{{ $exam->name }}</h1>
        </div>
    </header>
    <div class="container-fluid main-content">
        <div class="row h-100">
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="d-flex flex-column h-100">
                    <div id="timer" class="mb-4">
                        <h6>Thời gian còn lại: <span id="time-left"></span></h6>
                    </div>
                    <h5>Câu hỏi</h5>
                
                    <!-- Question numbers grid -->
                    <div id="questionList" class="d-flex flex-wrap">
                        @foreach ($allQuestions as $index => $question)
                            @php
                                $page = ceil(($index + 1) / $questions->perPage());
                            @endphp
                            <div class="question-number {{ $index + 1 === 1 ? 'active' : '' }}" data-question="{{ $question->id }}" data-page="{{ ceil(($index + 1) / $questions->perPage()) }}">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-auto pt-3">
                        <div class="d-flex align-items-center mb-2">
                            <div class="question-number me-2" style="background-color: #f8f9fa; border: 1px solid #dee2e6; width: 20px; height: 20px;"></div>
                            <small>Chưa trả lời</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="question-number me-2" style="background-color: #039a35; color: white; width: 20px; height: 20px;"></div>
                            <small>Đã trả lời</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="question-number me-2 active" style="background-color: #9da0a5; width: 20px; height: 20px;"></div>
                            <small>Câu hỏi hiện tại</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right content area with questions -->
            <div class="col-md-9 col-lg-11">
                <form action="{{ route('submit.answers') }}" method="POST">
                @csrf
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                <div id="questionsContent">
                    @foreach($questions as $index => $question)
                    <div class="question-container" id="question-{{ $question->id }}">
                        <!-- Tiêu đề câu hỏi -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Câu hỏi {{ ($questions->currentPage() - 1) * $questions->perPage() + $loop->iteration }}</h5>
                            <span class="question-type-badge {{ $question->question_type == 'single' ? 'bg-info' : 'bg-warning' }}">
                                {{ $question->question_type == 'single' ? 'Một lựa chọn đúng' : 'Nhiều lựa chọn đúng' }}
                            </span>
                        </div>
                        
                        <!-- Nội dung câu hỏi -->
                        <p>{{ $question->question_text }}</p>
            
                        <!-- Các lựa chọn trả lời -->
                        <div class="options-container">
                            @foreach($question->answers as $answer)
                            <div class="choice-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="{{ $question->question_type == 'single' ? 'radio' : 'checkbox' }}" 
                                        id="answer-{{ $answer->id }}" data-question-id="{{ $question->id }}"  name="question_{{ $question->id }}{{ $question->question_type == 'multiple' ? '[]' : '' }}"
                                        value="{{ $answer->id }}">
                                    <label class="form-check-label" for="answer-{{ $answer->id }}">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    {{ $questions->links() }}
                </div>
                <div class="d-flex justify-content-end fixed-bottom bg-white p-3 border-top" style="left: auto; width: calc(100% - 25%);">
                    <button id="submitBtn" class="btn btn-success" type="submit">Nộp bài</button>
                </div>
                </form>
                
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const timeleft = {{ $timeleft }};
        const studentExam = {{ $studentExam->id }};
        const savedAnswersFromDB = @json($savedAnswers);
    </script>
    <script>
    
    //Xử lý chọn đáp án
    const questionNumbers = document.querySelectorAll('.question-number');
    const questionContainers = document.querySelectorAll('.question-container');
    const questionsContent = document.getElementById('questionsContent');

    // Bấm vào số câu
    questionNumbers.forEach(number => {
        number.addEventListener('click', function () {
            const questionId = this.getAttribute('data-question');
            const targetPage = this.getAttribute('data-page');
            const currentPage = {{ $questions->currentPage() }};

            if (parseInt(targetPage) !== currentPage) {
                // Chuyển hướng sang trang tương ứng
                const url = new URL(window.location.href);
                url.searchParams.set('page', targetPage);
                window.location.href = url.toString();
                localStorage.setItem('scrollToQuestionId', questionId);
            } else {
                // Nếu cùng trang, scroll đến câu hỏi
                const targetQuestion = document.getElementById('question-' + questionId);

                // Bỏ active cũ
                document.querySelectorAll('.question-number').forEach(num => {
                    if (!num.classList.contains('answered')) {
                        num.classList.remove('active');
                    }
                });
                document.querySelectorAll('.question-container').forEach(q => q.classList.remove('active'));

                this.classList.add('active');
                targetQuestion.classList.add('active');
                targetQuestion.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });


    // Xử lý chọn đáp án
    document.querySelectorAll('.choice-option input').forEach(input => {
        input.addEventListener('change', function () {
            // const questionId = this.name.replace('question_', '');
            const questionId = this.dataset.questionId;
            const questionNumber = document.querySelector(`.question-number[data-question="${questionId}"]`);
            const questionType = this.type; // radio hoặc checkbox
            let selected = [];

            if (questionType === 'radio') {
                if (this.checked) {
                    questionNumber.classList.add('answered');
                    selected = [this.value];
                }
            } else if (questionType === 'checkbox') {
                const options = document.querySelectorAll(`input[name="question_${questionId}[]"]`);
                let anyChecked = false;
                options.forEach(opt => {
                    if (opt.checked){
                        anyChecked = true;
                        selected.push(opt.value);
                    } 
                });
                if (anyChecked) {
                    questionNumber.classList.add('answered');
                } else {
                    questionNumber.classList.remove('answered');
                }
            }
            localStorage.setItem(`question_${studentExam}_${questionId}`, JSON.stringify(selected));
        });
    });
    //Khôi phục câu trả lời khi tải lại trang

    function restoreAnswers() {
        document.querySelectorAll('.choice-option input').forEach(input => {
            const questionId = input.dataset.questionId;
            const saved = savedAnswersFromDB[questionId];

            if (saved && saved.map(String).includes(input.value)) {
                input.checked = true;
            }
        });

        // Hiển thị đánh dấu đã chọn trên sidebar/number list
        document.querySelectorAll('.question-number').forEach(number => {
            const questionId = number.getAttribute('data-question');
            const saved = savedAnswersFromDB[questionId];
            const key = `question_${studentExam}_${questionId}`;
            if (saved && saved.length > 0) {
                number.classList.add('answered');
                localStorage.setItem(key, JSON.stringify(saved));
            }
        });
    }


    function clearStudentExamStorage() {
        for (let key in localStorage) {
            if (key.startsWith(`question_${studentExam}_`)) {
                localStorage.removeItem(key);
            }
        }
    }

    //Xử lý timer
    let timeLimit;

    function restoreTimer() {
        timeLimit = timeleft;

        const timeLeftElement = document.getElementById('time-left');
        const timerInterval = setInterval(function () {
            let minutes = Math.floor(timeLimit / 60);
            let seconds = timeLimit % 60;
            timeLeftElement.textContent = `${formatTime(minutes)}:${formatTime(seconds)}`;

            if (timeLimit <= 0) {
                clearInterval(timerInterval);
                alert("Hết thời gian!");
                document.getElementById('submitBtn').click();
            }
            timeLimit--;
        }, 1000);
    }

    setInterval(() => {
        const answers = {};
        const prefix = `question_${studentExam}_`;

        for (let key in localStorage) {
            if (key.startsWith(prefix)) {
                try {
                    const value = JSON.parse(localStorage.getItem(key));
                    const questionId = key.replace(prefix, '');
                    answers[questionId] = value;
                } catch (e) {}
            }
        }

        fetch('/api/auto-save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                student_exam_id: studentExam,
                answers: answers
            })
        });
    }, 2000);


    function formatTime(time) {
        return time < 10 ? '0' + time : time;
    }

    // Bắt đầu đếm ngược khi trang tải
    window.onload = function () {
        restoreAnswers();     // Khôi phục đáp án đã chọn
        restoreTimer();       // Khôi phục thời gian còn lại

        //cuộn đến câu hỏi khi chuyển đến trang khác
        const scrollToId = localStorage.getItem('scrollToQuestionId');
        if (scrollToId) {
            const target = document.getElementById('question-' + scrollToId);
            if (target) {
                target.classList.add('active');
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Highlight số câu bên sidebar
                document.querySelectorAll('.question-number').forEach(num => {
                    if (!num.classList.contains('answered')) num.classList.remove('active');
                });
                const numberEl = document.querySelector(`.question-number[data-question="${scrollToId}"]`);
                if (numberEl) numberEl.classList.add('active');
            }

            localStorage.removeItem('scrollToQuestionId');
        }
    };

    window.addEventListener('beforeunload', function () {
        clearStudentExamStorage();
    });

    // Lắng nghe sự kiện khi học viên nhấn nút nộp bài
    document.getElementById('submitBtn').addEventListener('click', function () {
        const form = document.querySelector('form');
    
        // Tạo input ẩn chứa tất cả câu trả lời
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'answers_data';
        
        // Lọc tất cả key localStorage bắt đầu bằng "question_"
        const answers = {};
        const prefix = `question_${studentExam}_`;
        for (let key in localStorage) {
            if (key.startsWith(prefix)) {
                try {
                    const value = JSON.parse(localStorage.getItem(key));
                    if (Array.isArray(value)) {
                        const questionId = key.replace(prefix, '');
                        answers[questionId] = value;
                    }
                } catch (e) {}
            }
        }

        input.value = JSON.stringify(answers);
        form.appendChild(input); // thêm input vào form

        clearStudentExamStorage();
    });

    </script>
</body>
</html>