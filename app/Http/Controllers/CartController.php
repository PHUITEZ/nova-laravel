<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['userId' => Auth::id()]);
        }
        return null;
    }
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui Lòng Đăng Nhập Để Xem Giỏ Hàng');
        }
        $cart = $this->getCart();
        $cartItems = $cart->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        // 1️⃣ Bắt đăng nhập
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng');
        }

        // 2️⃣ Validate dữ liệu
        $request->validate([
            'productId' => 'required|exists:products,id',
            'quantity'  => 'nullable|integer|min:1'
        ]);

        $quantityToAdd = $request->quantity ?? 1;

        // 3️⃣ Lấy sản phẩm
        $product = Product::findOrFail($request->productId);

        // 🚫 4️⃣ CHẶN NẾU HẾT HÀNG
        if ($product->stock <= 0) {
            return back()->with('error', 'Sản phẩm đã hết hàng');
        }

        // 5️⃣ Lấy giỏ hàng hiện tại
        $cart = $this->getCart();

        // 6️⃣ Tìm item trong giỏ
        $cartItem = CartItem::where('cartId', $cart->id)
            ->where('productId', $product->id)
            ->first();

        $currentQty = $cartItem ? $cartItem->quantity : 0;

        // 🚫 7️⃣ CHẶN VƯỢT QUÁ TỒN KHO
        if ($currentQty + $quantityToAdd > $product->stock) {
            return back()->with(
                'error',
                'Số lượng vượt quá tồn kho (còn ' . $product->stock . ' sản phẩm)'
            );
        }

        // 8️⃣ Thêm / cập nhật giỏ
        if ($cartItem) {
            $cartItem->quantity = $currentQty + $quantityToAdd;
            $cartItem->save();
        } else {
            CartItem::create([
                'cartId'    => $cart->id,
                'productId' => $product->id,
                'quantity'  => $quantityToAdd
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update(Request $request, $itemId)
    {
        if (!Auth::check())
            return redirect()->route('login');
        $cartItem = CartItem::findOrFail($itemId);
        if ($request->quantity > 0) {
            if ($request->quantity > $cartItem->product->stock) {
                return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho (còn ' . $cartItem->product->stock . ')');
            }
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }
        return redirect()->route('cart.index');
    }
    public function remove($itemId)
    {
        if (!Auth::check())
            return redirect()->route('login');
        CartItem::destroy($itemId);
        return redirect()->route('cart.index');
    }
}