<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller{
public function checkout(){
if(!Auth::check()) return redirect()->route('login');
$cart=Cart::where('userId',Auth::id())->first();
if(!$cart||$cart->cartItems->isEmpty()){
return redirect()->route('cart.index')->with('error','Giỏ Hàng Trống');
}
$cartItems=$cart->cartItems()->with('product')->get();
$total=$cartItems->sum(function($item){
return $item->quantity*$item->product->price;
});
return view('customer.checkout.index',compact('cartItems','total'));
}
public function placeOrder(Request $request){
$request->validate(['address'=>'required','phone'=>'required']);
$cart=Cart::where('userId',Auth::id())->first();
$cartItems=$cart->cartItems()->with('product')->get();
$total=$cartItems->sum(function($item){
return $item->quantity*$item->product->price;
});
$order=Order::create(['userId'=>Auth::id(),'total'=>$total,'address'=>$request->address,'phone'=>$request->phone,'status'=>'pending']);
foreach($cartItems as $item){
OrderItem::create(['orderId'=>$order->id,'productId'=>$item->productId,'quantity'=>$item->quantity,'price'=>$item->product->price]);
}
$cart->cartItems()->delete();
return redirect()->route('home')->with('success','Đặt Hàng Thành Công');
}
}