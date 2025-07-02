<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::orderBy('course_id')->orderBy('order_number')->get();
        return view('admin.chapter.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.chapter.add',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order_number' => 'required|numeric|min:1',
            'course_id' => 'required|exists:courses,id',
        ]);

        try {
            Chapter::where('course_id', $request->course_id)
            ->where('order_number', '>=', $request->order_number)
            ->increment('order_number');
            Chapter::create([
                'title' => $validated['title'],
                'order_number' => $validated['order_number'],
                'course_id' => $validated['course_id'],
            ]);
            return redirect()->route('chapter.index')->with('success', 'Thêm mới chương thành công !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không thể thêm mới chương');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        $courses = Course::all();
        return view('admin.chapter.edit', compact('chapter', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chapter = Chapter::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'order_number' => 'required|numeric|min:1',
            'course_id' => 'required|exists:courses,id',
        ]);
        try{
        // if ($request->order_number != $chapter->order_number) {
        // Chapter::where('course_id', $request->course_id)
        //     ->where('order_number', '>=', $request->order_number)
        //     ->where('id', '!=', $chapter->id)
        //     ->increment('order_number');
        // }
        if ($request->course_id != $chapter->course_id) {
    // Giảm thứ tự các chương sau trong course cũ
        Chapter::where('course_id', $chapter->course_id)
        ->where('order_number', '>', $chapter->order_number)
        ->decrement('order_number');

    // Tăng thứ tự các chương trong course mới
        Chapter::where('course_id', $request->course_id)
        ->where('order_number', '>=', $request->order_number)
        ->increment('order_number');
        } elseif ($request->order_number != $chapter->order_number) {
    // Chỉ xử lý tăng thứ tự nếu cùng khóa học nhưng đổi vị trí
         Chapter::where('course_id', $request->course_id)
        ->where('order_number', '>=', $request->order_number)
        ->where('id', '!=', $chapter->id)
        ->increment('order_number');
}
        $chapter->update($validated);
        return redirect()->route('chapter.index')->with('success', 'Cập nhật chương thành công!');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapter = Chapter::findOrFail($id);
        $courseId = $chapter->course_id;
        $orderNumber = $chapter->order_number;

    
        $chapter->delete();

    
        Chapter::where('course_id', $courseId)
        ->where('order_number', '>', $orderNumber)
        ->decrement('order_number');

        return redirect()->route('chapter.index')->with('success', 'Xoá chương thành công');
    }
}
