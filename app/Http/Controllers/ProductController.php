<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('categoryId', $category->id);
            }
        }

        if ($request->has('sort')) {
            $sort = $request->sort;
            if ($sort == 'priceAsc' || $sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort == 'priceDesc' || $sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::all();
        return view('customer.product.index', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = Product::where('categoryId', $product->categoryId)->where('id', '!=', $product->id)->take(4)->get();
        return view('customer.product.show', compact('product', 'relatedProducts'));
    }
}