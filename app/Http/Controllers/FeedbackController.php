<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function rating(Request $req){
        $rating = Feedback::where($req->only('student_id','course_id'))->first();
        if($rating){
            Feedback::where($req->only('student_id','course_id'))
            ->update($req->only('rating'));
        }
        else{
            Feedback::create($req->only('student_id','course_id','rating'));
        }
        return redirect()->back();
    }

    public function evaluation(Request $req){
        $eval = Feedback::where($req->only('student_id','course_id'))->first();
        if($eval){
            Feedback::where($req->only('student_id','course_id'))
            ->update($req->only('comment'));
        }
        else{
            return redirect()->back()->with('error', 'Bạn phải đánh giá sao cho khóa học trước !');
        }
        return redirect()->back()->with('success', 'Đánh giá của bạn đã được lưu !');
    }
}
