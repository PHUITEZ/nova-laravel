<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        if (!Auth::check())
            return redirect()->route('login');

        $cart = Cart::where('userId', Auth::id())->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ Hàng Trống');
        }

        $cartItems = $cart->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('customer.checkout.index', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required'
        ]);

        $user = Auth::user();
        $cart = Cart::where('userId', $user->id)->first();

        // Kiểm tra giỏ hàng rỗng
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống');
        }

        $cartItems = $cart->cartItems()->with('product')->get();

        // Kiểm tra tồn kho trước khi tạo đơn
        // Nếu phát hiện sản phẩm nào không đủ hàng -> Đẩy ngược về giỏ hàng báo lỗi
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('cart.index')->with('error', 
                    'Sản phẩm "' . $item->product->name . '" không đủ hàng (Còn: ' . $item->product->stock . '). Vui lòng cập nhật lại số lượng.');
            }
        }

        // Bắt đầu Giao dịch (Transaction)
        // Nếu có lỗi xảy ra trong quá trình này, mọi thay đổi sẽ được hoàn tác (Rollback)
        DB::transaction(function () use ($user, $cartItems, $cart, $request) {
            
            // 1. Tính tổng tiền
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // 2. Tạo Order (Đơn hàng)
            $order = Order::create([
                'userId' => $user->id,
                'total' => $total,
                'address' => $request->address,
                'phone' => $request->phone,
                'status' => 'pending' // Mặc định là chờ xử lý
            ]);

            // 3. Tạo Order Items (Chi tiết đơn hàng)
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'orderId' => $order->id,
                    'productId' => $item->productId,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // 4. Xóa sạch giỏ hàng sau khi đặt thành công
            $cart->cartItems()->delete();
        });

        return redirect()->route('home')->with('success', 'Đặt Hàng Thành Công');
    }
}