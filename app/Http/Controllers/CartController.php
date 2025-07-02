<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Course;
use App\Models\CartDetail;

class CartController extends Controller
{
    public function addToCart(Course $course){
        $cart = Cart::where('student_id', auth('stu')->id());
        if($cart->exists()){
            $cart = $cart->first();
            $cartDetail = CartDetail::where('cart_id', $cart->id)->where('course_id', $course->id);
            if($cartDetail->exists()){

            }
            else{
                CartDetail::create([
                    'cart_id' => $cart->id,
                    'course_id' => $course->id
                ]);
            }
        }else{
            $newCart = Cart::create([
                'student_id' => auth('stu')->id()
            ]);
            CartDetail::create([
                'cart_id' => $newCart->id,
                'course_id' => $course->id
            ]);
        }
        return redirect()->route('viewCart');
    }
    public function viewCart(){
        $cart = Cart::where('student_id', auth('stu')->id())
        ->with('cartDetails:cart_id,course_id')
        ->with('cartDetails.course:id,name,price')
        ->first();
        return view('frontend.cart', compact('cart'));
    }
    public function deleteCart(Request $req){
        CartDetail::find($req->cartDetailId)
        ->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
