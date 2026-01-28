<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
class HomeController extends Controller{
public function index(){
$featuredProducts=Product::latest()->take(4)->get();
$categories=Category::all();
return view('customer.home',compact('featuredProducts','categories'));
}
}