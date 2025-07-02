@extends('admin.master')
@section('title','Cập nhật bài học')
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
@endsection
@section('main-content')
<div class="container-fluid">

  <div class="content">
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('lesson.update',$lesson)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="">Tên bài học</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên bài học" value="{{$lesson->name}}">
                @error('name')
                    <span class="text-danger"> {{$message}}</span>
                @enderror
                @error('errors')
                    <span class="text-danger"> {{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" id="editor1" rows="10" cols="80" class="form-control" placeholder="">
                    {!!$lesson->description!!}
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">Bài học số</label>
                    <input type="number" min="1" class="form-control" id="order_number" name="order_number" placeholder="" value="{{$lesson->order_number}}">
                    @error('order_number')
                        <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Bài giảng</label>
                    <input type="file" class="form-control" id="file" name="file" placeholder="Chọn bài giảng">
                    @error('file')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Thời lượng đạt</label>
                    <input type="number" min="1" class="form-control" id="percent" name="percent" value="{{$lesson->percent}}" placeholder="">
                    @error('percent')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Chọn khóa học</label>
                    <select name="course_id" id="course-select" class="form-control">
                        @foreach ($courses as $item)
                            <option value="{{ $item->id }}" {{ $lesson->course_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Chọn chương</label>
                    <select name="chapter_id" id="chapter-select" class="form-control" required>
                        @foreach ($lesson->course->chapters as $chapter)
                            <option value="{{ $chapter->id }}" {{ $lesson->chapter_id == $chapter->id ? 'selected' : '' }}>{{ $chapter->title }}</option>
                        @endforeach
                    </select>
                    @error('chapter_id') 
                        <span class="text-danger">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Là bài học mẫu:</label>
                    <div class="radio">
                    <p>
                        <input type="radio" name="is_sample" value="1" {{$lesson->is_sample ? 'checked' : ""}}>
                        Có
                    </p>
                    <p>
                        <input type="radio" name="is_sample" value="0" {{!$lesson->is_sample ? 'checked' : ""}}>
                        Không
                    </p>
                    </div>
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


