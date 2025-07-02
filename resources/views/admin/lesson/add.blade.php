@extends('admin.master')
@section('title','Thêm bài học')
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
        <form method="POST" action="{{route('lesson.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                <label for="">Tên bài học</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên bài học">
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
                    
                </textarea>
                </div>
                <div class="form-group">
                    <label for="">Bài học số</label>
                    <input type="number" min="1" class="form-control" id="order_number" name="order_number" placeholder="">
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
                    <label for="">Thời lượng đạt (phần trăm)</label>
                    <input type="number" min="1" class="form-control" id="percent" name="percent" placeholder="">
                    @error('percent')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror
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
                    <label for="">Là bài học mẫu:</label>
                    <div class="radio">
                    <p>
                        <input type="radio" name="is_sample" value="1" checked>
                        Có
                    </p>
                    <p>
                        <input type="radio" name="is_sample" value="0">
                        Không
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


