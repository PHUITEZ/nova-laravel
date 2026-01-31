@extends('layouts.master')
@section('title', 'Trang Chủ')
@section('content')
    <section class="heroSection animateFade">
        <h1 class="heroTitle">Thời Trang NOVA</h1>
        <p class="heroSubtitle">Thiết Kế Tối Giản Cho Người Hiện Đại. Chất Liệu Cao Cấp, Sản Xuất Bền Vững Và Vẻ Đẹp Vượt
            Thời Gian.</p>
        <div class="flexCenter" style="gap: 1.5rem;">
            <a href="{{route('products.index')}}" class="primaryButton">Mua Ngay</a>
        </div>
    </section>
    <section id="featured" class="mt4 mb4">
        <div class="row">
            @foreach($categories as $category)
                <div class="col"
                    style="height: 400px; position: relative; overflow: hidden; border-radius: 12px; cursor: pointer;">
                    <a href="{{route('products.index', ['category' => $category->slug])}}">
                        <img src="{{$category->image}}"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        <div
                            style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 2rem; background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                            <h3 style="color: white; margin: 0; letter-spacing: 0.1em;">{{$category->name}}</h3>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <section class="mt4 mb4">
        <div class="flexBetween mb4">
            <h2 style="font-size: 2rem; margin: 0;">Sản Phẩm Mới</h2>
            <a href="{{route('products.index')}}" style="border-bottom: 2px solid var(--text-main);">Xem Tất Cả</a>
        </div>
        <div class="productGrid">
            @foreach($featuredProducts as $product)
                <div class="productCard">
                    <a href="{{route('products.show', $product->id)}}" class="productImage" style="display:block;">
                        <img src="{{$product->image}}" alt="{{$product->name}}">
                        @if($loop->first)
                            <span class="badge badgeSuccess" style="position:absolute; top: 1rem; left: 1rem;">Mới</span>
                        @endif
                    </a>
                    <div class="productInfo">
                        <p style="font-size: 0.8rem; color: var(--text-light); margin: 0 0 0.5rem;">{{$product->category->name}}
                        </p>
                        <h3 class="productTitle"><a href="{{route('products.show', $product->id)}}"
                                class="noDecor">{{$product->name}}</a></h3>
                        <div class="flexBetween">
                            <span class="productPrice">{{number_format($product->price)}} đ</span>
                            <form action="{{route('cart.add')}}" method="POST">
                                @csrf
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <button type="submit" class="qtyBtn"
                                    style="background:none; border: 1px solid var(--border-light); width: 30px; height: 30px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;">＋</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="mt4 mb4 animateFade"
        style="background: var(--text-main); color: white; padding: 4rem; border-radius: 12px; text-align: center;">
        <h2 style="color: white; margin-bottom: 1rem;">Tham Gia Với Chúng Tôi</h2>
        <p style="color: #ccc; margin-bottom: 2rem;">Đăng Ký Để Nhận Thông Tin Cập Nhật, Ưu Đãi Độc Quyền Và Nhiều Hơn Nữa.
        </p>
        <div class="flexCenter" style="gap: 1rem; max-width: 500px; margin: 0 auto; display: flex;">
            <input type="email" placeholder="Email Của Bạn"
                style="padding: 1rem; border-radius: 4px; border: none; flex: 1;">
            <a href="{{route('register')}}" class="primaryButton"
                style="background: white; color: black; border: none; border-radius: 4px; cursor: pointer; text-decoration:none; white-space: nowrap; min-width: 120px; display: flex; align-items: center; justify-content: center;">Đăng
                Ký</a>
        </div>
    </section>
@endsection