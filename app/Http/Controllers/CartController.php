<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller{
private function getCart(){
if(Auth::check()){
return Cart::firstOrCreate(['userId'=>Auth::id()]);
}
return null;
}
public function index(){
if(!Auth::check()){
return redirect()->route('login')->with('error','Vui Lòng Đăng Nhập Để Xem Giỏ Hàng');
}
$cart=$this->getCart();
$cartItems=$cart->cartItems()->with('product')->get();
$total=$cartItems->sum(function($item){
return $item->quantity*$item->product->price;
});
return view('customer.cart.index',compact('cartItems','total'));
}
public function add(Request $request){
if(!Auth::check()){
return redirect()->route('login')->with('error','Vui Lòng Đăng Nhập Để Thêm Vào Giỏ Hàng');
}
$product=Product::findOrFail($request->productId);
$cart=$this->getCart();
$cartItem=CartItem::where('cartId',$cart->id)->where('productId',$product->id)->first();
if($cartItem){
$cartItem->quantity+=$request->quantity??1;
$cartItem->save();
}else{
CartItem::create(['cartId'=>$cart->id,'productId'=>$product->id,'quantity'=>$request->quantity??1]);
}
return redirect()->back()->with('success','Đã Thêm Vào Giỏ Hàng');
}
public function update(Request $request,$itemId){
if(!Auth::check()) return redirect()->route('login');
$cartItem=CartItem::findOrFail($itemId);
if($request->quantity>0){
$cartItem->quantity=$request->quantity;
$cartItem->save();
}else{
$cartItem->delete();
}
return redirect()->route('cart.index');
}
public function remove($itemId){
if(!Auth::check()) return redirect()->route('login');
CartItem::destroy($itemId);
return redirect()->route('cart.index');
}
}