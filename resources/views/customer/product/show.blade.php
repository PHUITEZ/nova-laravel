@extends('layouts.master')
@section('title', $product->name)
@section('content')
<div style="max-width:1200px;margin:0 auto;">
    <div class="row" style="gap:3rem;align-items:flex-start;">
        <div class="col" style="flex:1;">
            <div style="position:sticky;top:120px;">
                
                @if(str_contains($product->image, 'http'))
                    <img src="{{$product->image}}" alt="{{$product->name}}" style="width:100%;height:auto;aspect-ratio:1;object-fit:cover;border-radius:16px;box-shadow:var(--shadow-md);">
                @else
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{$product->name}}" style="width:100%;height:auto;aspect-ratio:1;object-fit:cover;border-radius:16px;box-shadow:var(--shadow-md);">
                @endif

            </div>
        </div>
        <div class="col" style="flex:1;">
            <span class="badge badgeSuccess" style="display:inline-block;margin-bottom:1rem;">{{$product->category->name}}</span>
            <h1 style="font-size:2.5rem;margin:0 0 1rem 0;">{{$product->name}}</h1>
            <div style="display:flex;align-items:baseline;gap:1rem;margin-bottom:2rem;">
                <h2 style="font-size:2rem;margin:0;color:var(--accent);">{{number_format($product->price)}} đ</h2>
                <span style="text-decoration:line-through;color:var(--text-light);font-size:1.1rem;">{{number_format($product->price * 1.2)}} đ</span>
            </div>
            <div style="background:var(--bg-body);padding:1.5rem;border-radius:12px;margin-bottom:2rem;">
                <p style="margin:0;color:var(--text-light);line-height:1.6;">{{$product->description ?? 'Trải Nghiệm Sự Tinh Tế Và Đẳng Cấp Với Thiết Kế Này! Chất Liệu Cao Cấp Được Tuyển Chọn Kỹ Lưỡng, Mang Lại Cảm Giác Thoải Mái Tuyệt Đối Cho Người Mặc!'}}</p>
            </div>
            @if($product->stock < 10)
                <div style="background:#FFF8E1;border:1px solid #F57F17;border-radius:8px;padding:1rem;margin-bottom:1.5rem;">
                    <p style="margin:0;color:#F57F17;font-size:0.9rem;">Chỉ Còn {{$product->stock}} Sản Phẩm!</p>
                </div>
            @endif
            <form action="{{route('cart.add')}}" method="POST">
                @csrf
                <input type="hidden" name="productId" value="{{$product->id}}">
                <div style="background:var(--bg-body);padding:1.5rem;border-radius:12px;margin-bottom:1.5rem;">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span style="color:var(--text-light);">Số Lượng</span>
                        <div class="quantityControl">
                            <button type="button" class="qtyBtn" onclick="if(document.getElementById('qty').value>1)document.getElementById('qty').value--">-</button>
                            <input type="number" name="quantity" id="qty" value="1" min="1" max="{{$product->stock}}" class="qtyInput" style="width:60px;text-align:center;">
                            <button type="button" class="qtyBtn" onclick="if(document.getElementById('qty').value<{{$product->stock}})document.getElementById('qty').value++">+</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="primaryButton w100" style="padding:1.2rem;font-size:1.1rem;">Thêm Vào Giỏ Hàng</button>
            </form>
        </div>
    </div>
    @if($relatedProducts->count() > 0)
        <div style="margin-top:4rem;">
            <h2 style="text-align:center;margin-bottom:2rem;font-size:1.8rem;">Có Thể Bạn Thích</h2>
            <div class="productGrid">
                @foreach($relatedProducts as $related)
                    <div class="productCard">
                        <a href="{{route('products.show',$related->id)}}" class="productImage" style="display:block;height:250px;">
                            
                            @if(str_contains($related->image, 'http'))
                                <img src="{{$related->image}}" alt="{{$related->name}}">
                            @else
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{$related->name}}">
                            @endif

                        </a>
                        <div class="productInfo">
                            <h3 class="productTitle" style="font-size:1rem;">{{$related->name}}</h3>
                            <p class="productPrice">{{number_format($related->price)}} đ</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection