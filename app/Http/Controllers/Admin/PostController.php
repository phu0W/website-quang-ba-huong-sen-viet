<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt = 1;
        $posts = Post::all();
        $this->authorize('viewAny', Post::class);
        return view('admin.new.index',compact('stt','posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('admin.new.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'photo'=>'nullable|mimes:png,jpg,jpeg,webp',
        ],
        [
            'title.required'=>'Bạn chưa nhập tiêu đề !',
            'title.string'=>'Tiêu đề là dạng chuỗi !',
            'content.required'=>'Bạn chưa nhập nội dung !',
            'content.string'=>'Nội dung là dạng chuỗi !',
            'photo.mimes' => 'Ảnh phải có định dạng png, jpg, jpeg hoặc webp !',
        ]);
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/posts/';
            $file->move($path, $fileName);

            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
        }

        try {
            $post = Post::create($request->all());

            // Kiểm tra kết quả
            if ($post) {
                return redirect()->route('post.index')->with('success', 'Thêm mới thành công !');
            }
        } catch (\Throwable $th) {
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
    public function edit(Request $request, Post $post)
    {
        $this->authorize('view', $post);
        return view('admin.new.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            'photo'=>'nullable|mimes:png,jpg,jpeg,webp',
        ],
        [
            'title.required'=>'Bạn chưa nhập tiêu đề !',
            'title.string'=>'Tiêu đề là dạng chuỗi !',
            'content.required'=>'Bạn chưa nhập nội dung !',
            'content.string'=>'Nội dung là dạng chuỗi !',
            'photo.mimes' => 'Ảnh phải có định dạng png, jpg, jpeg hoặc webp !',
        ]);
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/posts/';
            $file->move($path, $fileName);
            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
            //Xóa hình cũ
            $imgpath = $post->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
        }
        try{
            $post->update($request->all());
            return redirect()->route('post.index')->with('success', 'Cập nhật thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Cập nhật thất bại !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        try{
            $imgpath = $post->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
    public function ckeditor_image(Request $request){
        if($request->hasFile('upload')){
            $originalName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('uploads/ckeditor', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/ckeditor/'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";
            @header('Content-type: text/html; charset-utf-8');
            echo $response;
        }
    }
}
