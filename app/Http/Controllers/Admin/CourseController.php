<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use App\Http\Requests\Course\StoreCourseRequest;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt = 1;
        $courses = Course::all();
        $this->authorize('viewAny', Course::class);
        return view('admin.course.index', compact('courses', 'stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Course::class);
        $subjects = Subject::all();
        $teachers = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->where('roles.name', 'teacher')->select('users.*')->get();                                                                                                
        return view('admin.course.add', compact('subjects','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        // Kiểm tra và xử lý file ảnh
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/course/';
            $file->move($path, $fileName);

            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
        }

        try {
            $data = $request->only(['name','description','price','image','is_featured','subject_id','teacher_id']);
            $course = Course::create($data);

            if ($course) {
                return redirect()->route('course.index')->with('success', 'Thêm mới thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
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
    public function edit(Course $course)
    {
        $this->authorize('view', $course);
        $subjects = Subject::all();
        $teachers = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->where('roles.name', 'teacher')->select('users.*')->get();
        return view('admin.course.edit', compact('course','subjects','teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCourseRequest $request, Course $course)
    {
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/course/';
            $file->move($path, $fileName);
            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
            //Xóa hình cũ
            $imgpath = $course->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
        }
        try{
            $course->update($request->all());
            return redirect()->route('course.index')->with('success', 'Cập nhật thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        try{
            $imgpath = $course->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
            $course->delete();
            return redirect()->route('course.index')->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
}
