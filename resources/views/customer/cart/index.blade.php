@extends('layouts.master')
@section('title','Giỏ Hàng')
@section('content')
<h1 class="mb4 textCenter">Giỏ Hàng Của Bạn</h1>
@if($cartItems->count() > 0)
<div class="row" style="gap:2rem;align-items:flex-start;">
<div class="col" style="flex:2;">
<div class="glassContainer" style="padding:2rem;">
<table class="cartTable">
<thead>
<tr>
<th>Sản Phẩm</th>
<th>Giá</th>
<th>Số Lượng</th>
<th>Tổng</th>
<th></th>
</tr>
</thead>
<tbody>
@foreach($cartItems as $item)
<tr>
<td>
<div class="flexCenter" style="justify-content:flex-start;gap:1.5rem;">
<img src="{{$item->product->image}}" style="width:80px;height:80px;object-fit:cover;border-radius:12px;box-shadow:var(--shadowSm);">
<div>
<h4 style="margin:0;font-size:1.1rem;">{{$item->product->name}}</h4>
<span class="badge badgeWarning mt1" style="font-size:0.6rem;">{{$item->product->category->name}}</span>
</div>
</div>
</td>
<td>{{number_format($item->product->price)}} đ</td>
<td>
<form action="{{route('cart.update',$item->id)}}" method="POST" class="quantityControl" style="margin:0;transform:scale(0.9);">
@csrf
<button type="submit" name="quantity" value="{{$item->quantity-1}}" class="qtyBtn">-</button>
<input type="text" value="{{$item->quantity}}" class="qtyInput" readonly>
<button type="submit" name="quantity" value="{{$item->quantity+1}}" class="qtyBtn">+</button>
</form>
</td>
<td style="color:var(--primary);">{{number_format($item->quantity * $item->product->price)}} đ</td>
<td>
<a href="{{route('cart.remove',$item->id)}}" class="qtyBtn" style="width:35px;height:35px;background:var(--secondary);color:red;display:flex;align-items:center;justify-content:center;text-decoration:none;">X</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="col" style="flex:1;">
<div class="glassContainer" style="padding:2rem;position:sticky;top:120px;">
<h3 class="mb4" style="border-bottom:1px solid var(--glassBorder);padding-bottom:1rem;">Tổng Quan Đơn Hàng</h3>
<div class="flexBetween mb2" style="font-size:1.1rem;">
<span style="color:var(--textLight);">Tạm Tính</span>
<span>{{number_format($total)}} đ</span>
</div>
<div class="flexBetween mb2" style="font-size:1.1rem;">
<span style="color:var(--textLight);">Giảm Giá</span>
<span style="color:green;">-0 đ</span>
</div>
<div class="flexBetween mb4 pt2" style="border-top:1px dashed var(--glassBorder);font-size:1.4rem;">
<span>Thành Tiền</span>
<span style="color:var(--primary);">{{number_format($total)}} đ</span>
</div>
<a href="{{route('checkout')}}" class="primaryButton w100 textCenter">Tiến Hành Thanh Toán &rarr;</a>
<div class="mt4 textCenter">
<p style="font-size:0.9rem;opacity:0.7;">Bảo Mật Thanh Toán 100%</p>
</div>
</div>
</div>
</div>
@else
<div class="glassContainer textCenter" style="padding:6rem 2rem;max-width:800px;margin:0 auto;">
<h2 class="mb2">Giỏ Hàng Trống</h2>
<p class="mb4">Có Vẻ Như Bạn Chưa Chọn Được Món Đồ Nào Ưng Ý!</p>
<a href="{{route('products.index')}}" class="primaryButton">Tiếp Tục Mua Sắm</a>
</div>
@endif
@endsection