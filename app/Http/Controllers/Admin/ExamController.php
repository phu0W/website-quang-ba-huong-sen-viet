<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Chapter;
use App\Models\Question;
use Auth;
use Illuminate\Support\Facades\Validator;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->name === 'teacher') {
            // Lấy danh sách ID các khóa học mà giáo viên đang quản lý
            $courseIds = Course::where('teacher_id', Auth::id())->pluck('id');
    
            // Lấy bài học thuộc các khóa đó
            $exams = Exam::whereIn('course_id', $courseIds)->get();
        } else {
            // Admin: xem tất cả bài học
            $exams = Exam::all();
        }
        $stt = 1;
        return view('admin.exam.index', compact('exams','stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role->name === 'teacher') {
            $courses = Course::where('teacher_id', Auth::id())->get();
        } else {
            $courses = Course::all();
        }
        return view('admin.exam.add', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'pass_score'=>'required|numeric|min:1',
            'max_attempts'=>'required|numeric|min:1',
            'time'=>'required|numeric|min:1',
            'chapter_id' => 'required|exists:chapters,id',
            'question_count' => 'required|integer|min:1',
            'order_number' => 'required|integer|min:1',
            'easy_count' => 'required|integer|min:0',
            'hard_count' => 'required|integer|min:0',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài thi !',
            'name.string'=>'Tên bài thi là dạng chuỗi !',
            'pass_score.required'=>'Bạn chưa nhập điểm đạt !',
            'max_attempts.required'=>'Bạn chưa nhập số lần làm bài !',
            'time.required'=>'Bạn chưa nhập thời gian làm bài !',
            'pass_score.numeric'=>'Điểm đạt là dạng số !',
            'max_attempts.numeric'=>'Số lần thi là dạng số !',
            'time.numeric'=>'Thời gian thi là dạng số !',
        ]);
            $validator->after(function ($validator) use ($request) {
            $total = $request->question_count;
            $easy = $request->easy_count;
            $hard = $request->hard_count;

            if ($easy + $hard != $total) {
                $validator->errors()->add('easy_count', 'Tổng số câu dễ và khó phải bằng tổng số câu.');
            }
            $chapter = Chapter::withCount([
                'questions as easy_count' => function ($q) {
                    $q->where('difficulty', 'easy');
                },
                'questions as hard_count' => function ($q) {
                    $q->where('difficulty', 'hard');
                },
            ])->find($request->chapter_id);

            if (!$chapter) {
                $validator->errors()->add('chapter_id', 'Chương không tồn tại.');
                return;
            }

            if ($easy > $chapter->easy_count) {
                $validator->errors()->add('easy_count', 'Số câu hỏi dễ vượt quá số câu dễ trong chương.');
            }

            if ($hard > $chapter->hard_count) {
                $validator->errors()->add('hard_count', 'Số câu hỏi khó vượt quá số câu khó trong chương.');
            }

            if ($total > ($chapter->easy_count + $chapter->hard_count)) {
                $validator->errors()->add('question_count', 'Tổng câu hỏi vượt quá tổng số câu hỏi trong chương.');
            }
        });
        $validator->validate();
        //dd($request);
        try{
            Exam::create([
                'name' => $request->name,
                'description' => $request->description,
                'pass_score' => $request->pass_score,
                'order_number' => $request->order_number,
                'max_attempts' => $request->max_attempts,
                'time' => $request->time,
                'chapter_id' => $request->chapter_id,
                'question_count' => $request->question_count,
                'easy_count' => $request->easy_count,
                'hard_count' => $request->hard_count,
                'is_sample' => $request->is_sample ?? 0,
            ]);
            return redirect()->route('exam.index')->with('success', 'Thêm mới thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Thêm mới thất bại !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        if (Auth::user()->role->name === 'teacher') {
            $courses = Course::where('teacher_id', Auth::id())->get();
        } else {
            $courses = Course::all();
        }
        $this->authorize('view', $exam);
        return view('admin.exam.edit', compact('courses','exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name'=>'required|string',
            'pass_score'=>'required|numeric|min:1',
            'max_attempts'=>'required|numeric|min:1',
            'time'=>'required|numeric|min:1',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài thi !',
            'name.string'=>'Tên bài thi là dạng chuỗi !',
            'pass_score.required'=>'Bạn chưa nhập điểm đạt !',
            'max_attempts.required'=>'Bạn chưa nhập số lần làm bài !',
            'time.required'=>'Bạn chưa nhập thời gian làm bài !',
            'pass_score.numeric'=>'Điểm đạt là dạng số !',
            'max_attempts.numeric'=>'Số lần thi là dạng số !',
            'time.numeric'=>'Thời gian thi là dạng số !',
        ]);

        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'pass_score'=>'required|numeric|min:1',
            'max_attempts'=>'required|numeric|min:1',
            'time'=>'required|numeric|min:1',
            'chapter_id' => 'required|exists:chapters,id',
            'question_count' => 'required|integer|min:1',
            'order_number' => 'required|integer|min:1',
            'easy_count' => 'required|integer|min:0',
            'hard_count' => 'required|integer|min:0',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài thi !',
            'name.string'=>'Tên bài thi là dạng chuỗi !',
            'pass_score.required'=>'Bạn chưa nhập điểm đạt !',
            'max_attempts.required'=>'Bạn chưa nhập số lần làm bài !',
            'time.required'=>'Bạn chưa nhập thời gian làm bài !',
            'pass_score.numeric'=>'Điểm đạt là dạng số !',
            'max_attempts.numeric'=>'Số lần thi là dạng số !',
            'time.numeric'=>'Thời gian thi là dạng số !',
        ]);
            $validator->after(function ($validator) use ($request) {
            $total = $request->question_count;
            $easy = $request->easy_count;
            $hard = $request->hard_count;

            if ($easy + $hard != $total) {
                $validator->errors()->add('easy_count', 'Tổng số câu dễ và khó phải bằng tổng số câu.');
            }
            $chapter = Chapter::withCount([
                'questions as easy_count' => function ($q) {
                    $q->where('difficulty', 'easy');
                },
                'questions as hard_count' => function ($q) {
                    $q->where('difficulty', 'hard');
                },
            ])->find($request->chapter_id);

            if (!$chapter) {
                $validator->errors()->add('chapter_id', 'Chương không tồn tại.');
                return;
            }

            if ($easy > $chapter->easy_count) {
                $validator->errors()->add('easy_count', 'Số câu hỏi dễ vượt quá số câu dễ trong chương.');
            }

            if ($hard > $chapter->hard_count) {
                $validator->errors()->add('hard_count', 'Số câu hỏi khó vượt quá số câu khó trong chương.');
            }

            if ($total > ($chapter->easy_count + $chapter->hard_count)) {
                $validator->errors()->add('question_count', 'Tổng câu hỏi vượt quá tổng số câu hỏi trong chương.');
            }
        });
        $validator->validate();
        try {
            $exam->update($request->all());
            return redirect()->route('exam.index')->with('success','Cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $this->authorize('delete', $exam);
        try{
            $exam->delete();
            return redirect()->route('exam.index')->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
}
