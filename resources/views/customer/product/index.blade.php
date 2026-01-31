@extends('layouts.master')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="row">
        <div class="col3">
            <div class="glassContainer" style="padding:2rem;position:sticky;top:100px;">
                <h3 class="mb3" style="border-bottom:1px solid var(--glassBorder);padding-bottom:1rem;">Bộ Lọc</h3>
                <form action="{{route('products.index')}}" method="GET">
                    <div class="mb4">
                        <h4 class="mb2" style="font-size:1rem;letter-spacing:0.05em;color:var(--textLight);">Danh Mục</h4>
                        <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:0.8rem;">
                            <li>
                                <label class="cursorPointer flexBetween">
                                    <span>Tất Cả</span>
                                    <div class="glassContainer"
                                        style="width:20px;height:20px;border-radius:50%;padding:0;display:flex;justify-content:center;align-items:center;">
                                        <input type="radio" name="category" value=""
                                            {{request('category') == '' ? 'checked' : ''}} onchange="this.form.submit()"
                                            style="accent-color:var(--primary);">
                                    </div>
                                </label>
                            </li>
                            @foreach($categories as $cat)
                                <li>
                                    <label class="cursorPointer flexBetween">
                                        <span>{{$cat->name}}</span>
                                        <div class="glassContainer"
                                            style="width:20px;height:20px;border-radius:50%;padding:0;display:flex;justify-content:center;align-items:center;">
                                            <input type="radio" name="category" value="{{$cat->slug}}"
                                                {{request('category') == $cat->slug ? 'checked' : ''}} onchange="this.form.submit()"
                                                style="accent-color:var(--primary);">
                                        </div>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb4">
                        <h4 class="mb2" style="font-size:1rem;letter-spacing:0.05em;color:var(--textLight);">Sắp Xếp</h4>
                        <select name="sort" class="formInput" onchange="this.form.submit()">
                            <option value="newest" {{request('sort') == 'newest' ? 'selected' : ''}}>Mới Nhất</option>
                            <option value="price_asc" {{request('sort') == 'price_asc' ? 'selected' : ''}}>Giá Tăng Dần</option>
                            <option value="price_desc" {{request('sort') == 'price_desc' ? 'selected' : ''}}>Giá Giảm Dần</option>
                        </select>
                    </div>
                    <div class="mb4">
                        <button type="submit" class="primaryButton w100 textCenter" style="border-radius:12px;">Áp
                            Dụng</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col" style="flex:3;">
            <div class="glassContainer mb4"
                style="padding:2rem;display:flex;align-items:center;justify-content:space-between;background:linear-gradient(90deg, var(--glassSurface), rgba(255,255,255,0.4));">
                <div>
                    <h2 style="margin:0;font-size:2rem;">Cửa Hàng</h2>
                    <p style="margin:0.5rem 0 0;">{{$products->total()}} Sản Phẩm Tìm Thấy</p>
                </div>
            </div>
            @if($products->count() > 0)
                <div class="productGrid" style="padding:0;">
                    @foreach($products as $product)
                        <div class="productCard">
                            <a href="{{route('products.show', $product->id)}}" class="productImage"
                                style="display:block;height:250px;position:relative;">
                                <img src="{{$product->image}}" alt="{{$product->name}}">
                                @if($product->stock < 10)
                                    <span
                                        style="position:absolute;top:8px;left:8px;background:#F57F17;color:white;padding:0.4rem 0.8rem;border-radius:6px;font-size:0.75rem;">Chỉ
                                        Còn {{$product->stock}}</span>
                                @endif
                            </a>
                            <div class="productInfo">
                                <a href="{{route('products.show', $product->id)}}" style="text-decoration:none;color:inherit;">
                                    <h3 class="productTitle" style="font-size:1rem;">{{$product->name}}</h3>
                                </a>
                                <div class="flexBetween mt1">
                                    <p class="productPrice" style="margin:0;">{{number_format($product->price)}} đ</p>
                                    @if ($product->stock > 0)
                                        <form action="{{route('cart.add')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productId" value="{{$product->id}}">
                                            <button type="submit" class="qtyBtn"
                                                style="background:none; border: 1px solid var(--border-light); width: 30px; height: 30px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                                                ＋
                                            </button>
                                        </form>
                                    @else
                                        <button class="qtyBtn" disabled
                                            style="background:none; border: 1px solid #ccc; width: 30px; height: 30px; border-radius: 50%; cursor: not-allowed; opacity:0.5; display: flex; align-items: center; justify-content: center;">
                                            ✕
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt4 flexCenter">
                    {{$products->appends(request()->query())->links()}}
                </div>
            @else
                <div class="glassContainer textCenter" style="padding:4rem;">
                    <h3 style="color:var(--textLight);">Không Tìm Thấy Sản Phẩm Nào!</h3>
                    <a href="{{route('products.index')}}" class="primaryButton mt2">Xem Tất Cả</a>
                </div>
            @endif
        </div>
    </div>
@endsection