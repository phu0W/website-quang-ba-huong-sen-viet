@extends('admin.master')
@section('title','Thêm bài thi')
@section('custom')
    <script src="{{asset('assets\ckeditor\ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>

    <script>
        // Lắng nghe khi chọn khoá học
        document.getElementById('course-select').addEventListener('change', function () {
            const courseId = this.value;
            const chapterSelect = document.getElementById('chapter-select');
            chapterSelect.innerHTML = '<option>Đang tải...</option>';
            chapterSelect.disabled = true;

            if (courseId) {
                fetch(`/api/chapters/by-course/${courseId}`)
                    .then(response => response.json())
                    .then(data => {
                        chapterSelect.innerHTML = '<option value="">-- Chọn chương --</option>';
                        data.forEach(chapter => {
                            const option = document.createElement('option');
                            option.value = chapter.id;
                            option.textContent = chapter.title;
                            chapterSelect.appendChild(option);
                        });
                        chapterSelect.disabled = false;
                    });
            } else {
                chapterSelect.innerHTML = '<option value="">-- Chọn chương --</option>';
                chapterSelect.disabled = true;
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const totalInput = document.getElementById('question_count');
            const easyInput = document.getElementById('easy_count');
            const hardInput = document.getElementById('hard_count');

            function updateHardCount() {
                const total = parseInt(totalInput.value) || 0;
                const easy = parseInt(easyInput.value) || 0;
                const hard = Math.max(total - easy, 0);
                hardInput.value = hard;
            }

            easyInput.addEventListener('input', updateHardCount);
            totalInput.addEventListener('input', updateHardCount);
        });
    </script>
@endsection
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('exam.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tên bài thi</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên bài thi">
                    @error('name')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                    @error('errors')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="description" id="editor1" rows="10" cols="80" class="form-control" placeholder="Nhập mô tả">
                    
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">Chọn khóa học</label>
                    <select name="course_id" id="course-select" class="form-control">
                        <option value="">-- Chọn khóa học --</option>
                        @foreach ($courses as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Chọn chương</label>
                    <select name="chapter_id" id="chapter-select" class="form-control" required disabled>
                        <option value="">-- Chọn chương --</option>
                    </select>
                    @error('chapter_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="">Bài thi số</label>
                    <input type="number" min="1" class="form-control" id="order_number" name="order_number" placeholder="">
                    @error('order_number')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Điểm đạt:</label>
                    <input type="number" min="1" class="form-control" id="pass_score" name="pass_score" placeholder="Nhập điểm đạt">
                    @error('pass_score')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số lần làm</label>
                    <input type="number" min="1" class="form-control" id="max_attempts" name="max_attempts" placeholder="Nhập số lần làm">
                    @error('max_attempts')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="">Thời gian làm</label>
                    <input type="number" min="1" class="form-control" id="time" name="time" placeholder="Nhập thời gian làm">
                    @error('time')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Tổng số câu hỏi</label>
                    <input type="number" min="1" class="form-control" id="question_count" name="question_count">
                    @error('question_count')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số câu dễ</label>
                    <input type="number" min="0" class="form-control" id="easy_count" name="easy_count">
                    @error('easy_count')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số câu khó</label>
                    <input type="number" min="0" class="form-control" id="hard_count" name="hard_count" readonly>
                    @error('hard_count')
                        <span style="color: red"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Là bài thi thử:</label>
                    <div class="radio">
                        <p>
                            <input type="radio" name="is_sample" value="0" checked>
                            Không
                        </p>
                        <p>
                            <input type="radio" name="is_sample" value="1">
                            Có
                        </p>
                    </div>
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


