<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard()
    {
        // ❗ chỉ lấy đơn completed để tính tiền
        $orders = Order::with('user')->latest()->take(10)->get();

        $totalOrders = Order::where('status', 'completed')->count();
        $totalProducts = Product::count();

        $revenue = Order::where('status', 'completed')->sum('total');

        return view('admin.dashboard', compact(
            'orders',
            'totalOrders',
            'totalProducts',
            'revenue'
        ));
    }


    public function products(Request $request)
    {
        $query = Product::query();
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'categoryId' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc là file ảnh
            'stock' => 'required|integer',
            'description' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);
        return redirect()->route('admin.products')->with('success', 'Tạo Sản Phẩm Thành Công');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        DB::transaction(function () use ($order, $oldStatus, $newStatus) {

            if ($oldStatus === 'pending' && $newStatus === 'processing') {
                foreach ($order->orderItems as $item) {
                    $product = $item->product;

                    if ($product->stock < $item->quantity) {
                        throw new \Exception(
                            "Sản phẩm {$product->name} không đủ tồn kho"
                        );
                    }

                    $product->decrement('stock', $item->quantity);
                }
            }

            // 2️⃣ processing/completed → cancelled : HOÀN KHO
            if (
                in_array($oldStatus, ['processing', 'completed']) &&
                $newStatus === 'cancelled'
            ) {
                foreach ($order->orderItems as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // 3️⃣ Cập nhật trạng thái
            $order->update([
                'status' => $newStatus
            ]);
        });

        return back()->with('success', 'Cập Nhật Trạng Thái Thành Công');
    }


    public function customers()
    {
        $users = \App\Models\User::where('role', '!=', 'admin')->latest()->paginate(10);
        return view('admin.customers.index', compact('users'));
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'categoryId' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh không bắt buộc khi sửa
            'stock' => 'required|integer',
            'description' => 'nullable'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        } else {
            unset($validated['image']);
        }

        $product->update($validated);
        return redirect()->route('admin.products')->with('success', 'Cập Nhật Sản Phẩm Thành Công');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Xóa Sản Phẩm Thành Công');
    }

    public function editCustomer($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.customers.edit', compact('user'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required', 'email' => 'required|email', 'phone' => 'nullable', 'address' => 'nullable']);
        $user = \App\Models\User::findOrFail($id);
        $user->update($validated);
        return redirect()->route('admin.customers')->with('success', 'Cập Nhật Khách Hàng Thành Công');
    }

    public function deleteCustomer($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.customers')->with('success', 'Xóa Khách Hàng Thành Công');
    }
}