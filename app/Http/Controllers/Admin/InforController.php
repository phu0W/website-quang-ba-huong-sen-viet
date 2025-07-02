<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Infor;

class InforController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infor = Infor::find(1);
        $this->authorize('view', $infor);
        return view('admin.infor.edit', compact('infor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Infor $infor)
    {
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/infors/';
            $file->move($path, $fileName);
            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['logo' => $path . $fileName]);
            //Xóa hình cũ
            $imgpath = $infor->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
        }
        try{
            $infor->update($request->all());
            return redirect()->route('infor.index')->with('success', 'Cập nhật thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
