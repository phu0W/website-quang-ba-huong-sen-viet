<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\updateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt = 1;
        $subjects = Subject::all();
        $this->authorize('viewAny', Subject::class);
        return view('admin.subject.index', compact('subjects', 'stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Subject::class);
        return view('admin.subject.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/subject/';
            $file->move($path, $fileName);

            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
        }
        try{
            Subject::create($request->all());
            return redirect()->route('subject.index')->with('success', 'Thêm mới thành công !');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $this->authorize('view', $subject);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/subject/';
            $file->move($path, $fileName);
            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
            //Xóa hình cũ
            $imgpath = $subject->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
        }
        try{
            $subject->update($request->all());
            return redirect()->route('subject.index')->with('success', 'Cập nhật thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        try{
            $subject->delete();
            return redirect()->route('subject.index')->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
}
