<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::orderBy('course_id')->get();
        return view('admin.question.list_chapter', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    public function list(Chapter $chapter)
    {
        $stt = 1;
        //$this->authorize('view', $exam);
        $questions = Question::where('chapter_id', $chapter->id)->get();
        return view('admin.question.index',compact('chapter','questions','stt'));
    }

    public function add(Chapter $chapter)
    {
        return view('admin.question.add',compact('chapter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->answers);
        $request->validate([
            'question_text' => 'required|string',
            'answers.*.text' => 'required|string', // Câu trả lời phải có nội dung
            'correct_answer' => 'required_if:question_type,single|integer', // Kiểm tra xem có câu trả lời đúng cho câu hỏi đơn không
            'correct_answers' => 'required_if:question_type,multiple|array', // Kiểm tra xem có câu trả lời đúng cho câu hỏi nhiều lựa chọn không
        ], 
        [
            'question_text.required' => 'Bạn chưa nhập câu hỏi !',
            'question_text.string' => 'Câu hỏi thi là dạng chuỗi !',
            'answers.*.text.required' => 'Bạn chưa nhập đủ câu trả lời !',
            'correct_answer.required_if' => 'Bạn phải chọn câu trả lời đúng cho câu hỏi !',
            'correct_answers.required_if' => 'Bạn phải chọn câu trả lời đúng cho câu hỏi !',
        ]);    
        try {
            $question = new Question();
            $question->chapter_id = $request->chapter_id;
            $question->question_text = $request->question_text;
            $question->question_type = $request->question_type;
            $question->difficulty = $request->difficulty;
            $question->save();

            foreach($request->answers as $key => $answer){
                if(!empty($answer['text'])){
                    Answer::create([
                        'question_id'=>$question->id,
                        'answer_text'=>$answer['text'],
                        'is_correct'=>($request->question_type=='single') ? ($request->correct_answer == $key ? 1 : 0) : (isset($request->correct_answers) && in_array($key, $request->correct_answers) ? 1 : 0)
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Câu hỏi đã được lưu thành công !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }

    }

    // public function list(string $id)
    // {
    //     $stt = 1;
    //     $exam = Exam::find($id);
    //     $this->authorize('view', $exam);
    //     $questions = Question::where('exam_id', $id)->get();
    //     return view('admin.question.index',compact('exam','questions','stt'));
    // }
    
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $answers = Answer::where('question_id',$question->id)->get();
        return view('admin.question.edit', compact('question','answers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers.*.text' => 'required|string', // Câu trả lời phải có nội dung
            'correct_answer' => 'required_if:question_type,single|integer', // Kiểm tra xem có câu trả lời đúng cho câu hỏi đơn không
            'correct_answers' => 'required_if:question_type,multiple|array', // Kiểm tra xem có câu trả lời đúng cho câu hỏi nhiều lựa chọn không
        ], 
        [
            'question_text.required' => 'Bạn chưa nhập câu hỏi !',
            'question_text.string' => 'Câu hỏi thi là dạng chuỗi !',
            'answers.*.text.required' => 'Bạn chưa nhập đủ câu trả lời !',
            'correct_answer.required_if' => 'Bạn phải chọn câu trả lời đúng cho câu hỏi !',
            'correct_answers.required_if' => 'Bạn phải chọn câu trả lời đúng cho câu hỏi !',
        ]);
        //dd($request);
        try {
            $question->chapter_id = $request->chapter_id;
            $question->question_text = $request->question_text;
            $question->question_type = $request->question_type;
            $question->save();

            foreach($request->answers as $key => $answer){
                $ans = Answer::find($key);
                if($ans){
                    $ans->answer_text = $answer['text'];
                    $ans->is_correct = $request->question_type=='single' ? ($request->correct_answer == $key ? 1 : 0) : (isset($request->correct_answers) && in_array($key, $request->correct_answers) ? 1 : 0);
                    $ans->question_id = $question->id;
                    $ans->save();
                }
            }
            return redirect()->route('question.list',$request->exam_id)->with('success', 'Câu hỏi đã được cập nhật thành công !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $exam_id = $question->exam_id;
        try{
            $question->delete();
            return redirect()->route('question.list',$exam_id)->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
    
}
