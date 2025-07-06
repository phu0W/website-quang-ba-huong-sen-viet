<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt = 1;
        $sliders = Slider::all();
        $this->authorize('viewAny', Slider::class);
        return view('admin.slider.index', compact('sliders','stt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Slider::class);
        return view('admin.slider.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_number'=>'required|numeric|min:1',
            'photo'=>'required|mimes:png,jpg,jpeg,webp',
        ],
        [
            'order_number.required'=>'Bạn chưa nhập thứ tự ảnh !',
            'order_number.numeric'=>'Thứ tự ảnh là dạng số !',
            'photo.required'=>'Bạn chưa chọn ảnh !',
            'photo.mimes' => 'Ảnh phải có định dạng png, jpg, jpeg hoặc webp !',
        ]);
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/sliders/';
            $file->move($path, $fileName);

            // Merge ảnh vào request để lưu vào CSDL
            $request->merge(['image' => $path . $fileName]);
        }

        try {
            $slider = Slider::create($request->all());
            if ($slider) {
                return redirect()->route('slider.index')->with('success', 'Thêm mới thành công !');
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
    public function edit(Slider $slider)
    {
        $this->authorize('view', $slider);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'order_number'=>'required|numeric|min:1',
            'photo'=>'mimes:png,jpg,jpeg,webp',
        ],
        [
            'order_number.required'=>'Bạn chưa nhập thứ tự ảnh !',
            'order_number.numeric'=>'Thứ tự ảnh là dạng số !',
            'photo.mimes' => 'Ảnh phải có định dạng png, jpg, jpeg hoặc webp !',
        ]);
        if ($request->hasFile('photo') && $request->photo->isValid()) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/sliders/';
            $file->move($path, $fileName);

            $request->merge(['image' => $path . $fileName]);
            $imgpath = $slider->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
        }

        try {
            $slider->update($request->all());
            if ($slider) {
                return redirect()->route('slider.index')->with('success', 'Cập nhật thành công !');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $this->authorize('delete', $slider);
        try{
            $imgpath = $slider->image;
            if(file_exists($imgpath)){
                unlink($imgpath);
            }
            $slider->delete();
            return redirect()->route('slider.index')->with('success', 'Xóa thành công !');
        }
        catch(\Throwable $th){
            return redirect()->back()->with('error', 'Xóa thất bại !');
        }
    }
}
