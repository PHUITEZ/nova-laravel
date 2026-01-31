@extends('layouts.master')
@section('title','Thanh Toán')
@section('content')
<div style="max-width:1200px;margin:0 auto;">
<h1 style="font-size:2rem;margin-bottom:2rem;">Thanh Toán</h1>
<div class="row" style="gap:2rem;align-items:flex-start;">
<div class="col" style="flex:1.5;">
<form action="{{route('order.place')}}" method="POST" id="checkoutForm">
@csrf
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;margin-bottom:2rem;">
<h3 style="margin:0 0 1.5rem 0;font-size:1.3rem;display:flex;align-items:center;gap:0.75rem;">
<span style="background:var(--text-main);color:white;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;">1</span>
Thông Tin Giao Hàng
</h3>
<div class="row" style="gap:1rem;margin-bottom:1rem;">
<div class="col">
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Họ Và Tên</label>
<input type="text" class="formInput" value="{{auth()->user()->name}}" disabled style="background:var(--bg-body);">
</div>
<div class="col">
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Số Điện Thoại</label>
<input type="text" name="phone" class="formInput" value="{{auth()->user()->phone}}" required>
</div>
</div>
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Địa Chỉ Nhận Hàng</label>
<textarea name="address" class="formInput" rows="3" required style="resize:vertical;">{{auth()->user()->address}}</textarea>
</div>
</div>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;">
<h3 style="margin:0 0 1.5rem 0;font-size:1.3rem;display:flex;align-items:center;gap:0.75rem;">
<span style="background:var(--text-main);color:white;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.9rem;">2</span>
Phương Thức Thanh Toán
</h3>
<label style="display:block;padding:1.25rem;border:2px solid var(--text-main);border-radius:8px;cursor:pointer;margin-bottom:1rem;transition:all 0.3s;">
<div style="display:flex;align-items:flex-start;gap:1rem;">
<input type="radio" name="payment_method" value="cod" checked style="margin-top:0.25rem;accent-color:var(--text-main);width:18px;height:18px;">
<div style="flex:1;">
<h4 style="margin:0 0 0.5rem 0;font-size:1rem;">Thanh Toán Khi Nhận Hàng (COD)</h4>
<p style="margin:0;font-size:0.85rem;color:var(--text-light);">Trả Tiền Mặt Cho Shipper Khi Nhận Được Hàng</p>
</div>
</div>
</label>
<label style="display:block;padding:1.25rem;border:2px solid var(--border-light);border-radius:8px;cursor:not-allowed;opacity:0.5;">
<div style="display:flex;align-items:flex-start;gap:1rem;">
<input type="radio" name="payment_method" value="banking" disabled style="margin-top:0.25rem;width:18px;height:18px;">
<div style="flex:1;">
<h4 style="margin:0 0 0.5rem 0;font-size:1rem;">Chuyển Khoản Ngân Hàng</h4>
<p style="margin:0;font-size:0.85rem;color:var(--text-light);">Đang Bảo Trì Hệ Thống</p>
</div>
</div>
</label>
</div>
</form>
</div>
<div class="col" style="flex:1;">
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;position:sticky;top:120px;">
<h3 style="margin:0 0 1.5rem 0;font-size:1.3rem;">Đơn Hàng</h3>
<div style="margin-bottom:1.5rem;">
@foreach($cartItems as $item)
<div style="display:flex;justify-content:space-between;align-items:center;padding:1rem 0;border-bottom:1px solid var(--border-light);">
<div style="display:flex;align-items:center;gap:1rem;flex:1;">
<div style="position:relative;flex-shrink:0;">
<img src="{{$item->product->image}}" style="width:60px;height:60px;border-radius:8px;object-fit:cover;">
<span style="position:absolute;top:-8px;right:-8px;background:var(--accent);color:white;border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;font-size:0.75rem;">{{$item->quantity}}</span>
</div>
<div style="flex:1;min-width:0;">
<p style="margin:0 0 0.25rem 0;font-size:0.95rem;">{{$item->product->name}}</p>
<p style="margin:0;font-size:0.85rem;color:var(--text-light);">{{number_format($item->product->price)}} đ × {{$item->quantity}}</p>
</div>
</div>
<span style="font-size:0.95rem;white-space:nowrap;margin-left:1rem;">{{number_format($item->product->price * $item->quantity)}} đ</span>
</div>
@endforeach
</div>
<div style="padding:1.5rem 0;border-top:2px solid var(--border-light);margin-bottom:1.5rem;">
<div style="display:flex;justify-content:space-between;align-items:center;">
<span style="font-size:1.1rem;">Tổng Cộng</span>
<span style="font-size:1.5rem;color:var(--accent);">{{number_format($total)}} đ</span>
</div>
</div>
<button onclick="document.getElementById('checkoutForm').submit()" class="primaryButton w100" style="padding:1rem;font-size:1rem;">Xác Nhận Đặt Hàng</button>
</div>
</div>
</div>
</div>
@endsection