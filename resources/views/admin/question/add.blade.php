@extends('admin.master')
@section('title','Thêm câu hỏi')
@section('custom')
    <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        function changeQuestionType() {
            let type = document.getElementById("question_type").value;
            let inputs = document.querySelectorAll(".answer-radio");
    
            inputs.forEach(input => {
                input.type = (type === "single") ? "radio" : "checkbox";
                input.name = (type === "single") ? "correct_answer" : "correct_answers[]";
            });
        }
    </script>
@endsection
@section('main-content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="content">
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route('question.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="">Câu hỏi:</label>
                    <textarea name="question_text" id="editor1" rows="5" cols="80" class="form-control" placeholder="Nhập câu hỏi">
                        
                    </textarea>
                    @error('question_text')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc</label>
                        <input type="text" name="chapter_id" value="{{$chapter->id}}" hidden>
                        <p>{{ $chapter->title . ', ' . $chapter->course->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Độ khó</label>
                        <select name="difficulty" id="difficulty" class="form-select">
                            <option value="easy">Dễ</option>
                            <option value="hard">Khó</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="question_type" class="form-label">Chọn loại câu hỏi:</label>
                            <select name="question_type" id="question_type" class="form-select" onchange="changeQuestionType()">
                                <option value="single">Một lựa chọn đúng</option>
                                <option value="multiple">Nhiều lựa chọn đúng</option>
                            </select>
                        </div>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="85%">Đáp án</th>
                                    <th width="10%" class="text-center">Đáp án đúng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 4; $i++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="answers[{{ $i }}][text]" placeholder="Đáp án {{ $i }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="radio" name="correct_answer" value="{{ $i }}" class="answer-radio">
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                            @error('answers')
                                <span class="text-danger"> {{$message}}</span>
                                <br>
                            @enderror 
                            @error('correct_answers')
                                <span class="text-danger"> {{$message}}</span>
                                <br>
                            @enderror 
                            @error('correct_answer')
                                <span class="text-danger"> {{$message}}</span>
                                <br>
                            @enderror
                            @error('answers.*.text')
                                <span class="text-danger"> {{$message}}</span>
                            @enderror                                                           
                        </table>
                    </div>
                </div>
            <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


