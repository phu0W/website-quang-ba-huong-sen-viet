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
            <form method="POST" action="{{route('question.update',$question)}}">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="">Câu hỏi:</label>
                    <textarea name="question_text" id="editor1" rows="5" cols="80" class="form-control" placeholder="">
                        {!!$question->question_text!!}
                    </textarea>
                    @error('question_text')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Thuộc</label>
                        <input type="text" name="chapter_id" value="{{$question->chapter_id}}" hidden>
                        <p>{{ $question->chapter->title . ', ' . $question->chapter->course->name }}</p>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label for="question_type" class="form-label">Chọn loại câu hỏi:</label>
                            <select name="question_type" id="question_type" class="form-select" onchange="changeQuestionType()">
                                <option value="single" {{$question->question_type == "single" ? 'selected' : ""}}>Một lựa chọn đúng</option>
                                <option value="multiple" {{$question->question_type == "multiple" ? 'selected' : ""}}>Nhiều lựa chọn đúng</option>
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
                                @foreach ($answers as $item)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                            <input type="text" class="form-control" name="answers[{{ $item->id }}][text]" placeholder="" value="{{$item->answer_text}}">
                                        </td>
                                        <td class="text-center">
                                            <input type="{{$question->question_type == 'single' ? 'radio' : 'checkbox'}}" name="correct_answer{{ $question->question_type == 'single' ? '' : 's[]' }}" value="{{ $item->id }}" class="answer-radio" {{$item->is_correct ? 'checked' : ""}}>
                                        </td>
                                    </tr>   
                                @endforeach
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
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


