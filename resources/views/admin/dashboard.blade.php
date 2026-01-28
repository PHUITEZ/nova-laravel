@extends('layouts.master')
@section('title','Quản Trị')
@section('content')
<div class="row" style="gap:2rem;align-items:flex-start;">
<div class="col" style="flex:0 0 250px;">
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;position:sticky;top:120px;">
<div style="text-align:center;padding-bottom:1.5rem;border-bottom:1px solid var(--border-light);margin-bottom:1.5rem;">
<div style="width:70px;height:70px;background:var(--text-main);margin:0 auto 1rem;display:flex;justify-content:center;align-items:center;color:white;font-size:1.8rem;border-radius:50%;">{{substr(auth()->user()->name, 0, 1)}}</div>
<h3 style="margin:0 0 0.25rem 0;font-size:1.1rem;">{{auth()->user()->name}}</h3>
<p style="margin:0;font-size:0.85rem;color:var(--text-light);">Administrator</p>
</div>
<nav>
<ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.5rem;">
<li>
<a href="{{route('admin.dashboard')}}" style="display:block;padding:0.9rem 1rem;background:var(--text-main);color:white;border-radius:8px;text-decoration:none;transition:all 0.3s;">Tổng Quan</a>
</li>
<li>
<a href="{{route('admin.products')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Sản Phẩm</a>
</li>
<li>
<a href="{{route('admin.orders')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Đơn Hàng</a>
</li>
<li>
<a href="{{route('admin.customers')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Khách Hàng</a>
</li>
</ul>
</nav>
</div>
</div>
<div class="col" style="flex:1;">
<h1 style="margin:0 0 2rem 0;font-size:2rem;">Tổng Quan Shop</h1>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;margin-bottom:3rem;">
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:1.75rem;">
<p style="margin:0 0 0.5rem 0;color:var(--text-light);font-size:0.9rem;">Đơn Hàng</p>
<h2 style="margin:0;font-size:2.5rem;">{{$totalOrders}}</h2>
</div>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:1.75rem;">
<p style="margin:0 0 0.5rem 0;color:var(--text-light);font-size:0.9rem;">Sản Phẩm</p>
<h2 style="margin:0;font-size:2.5rem;">{{$totalProducts}}</h2>
</div>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:1.75rem;">
<p style="margin:0 0 0.5rem 0;color:var(--text-light);font-size:0.9rem;">Doanh Thu</p>
<h2 style="margin:0;font-size:2.5rem;color:var(--accent);">{{number_format($revenue)}} đ</h2>
</div>
</div>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;">
<h2 style="margin:0 0 1.5rem 0;font-size:1.3rem;">Đơn Hàng Gần Đây</h2>
<div style="overflow-x:auto;">
<table style="width:100%;border-collapse:collapse;">
<thead>
<tr style="border-bottom:2px solid var(--border-light);">
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">ID</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Khách Hàng</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Tổng Tiền</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Trạng Thái</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Ngày</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr style="border-bottom:1px solid var(--border-light);">
<td style="padding:1rem;">#{{$order->id}}</td>
<td style="padding:1rem;">{{$order->user->name}}</td>
<td style="padding:1rem;color:var(--accent);">{{number_format($order->total)}} đ</td>
<td style="padding:1rem;"><span class="badge {{$order->status=='pending'?'badgeWarning':'badgeSuccess'}}">{{ucfirst($order->status)}}</span></td>
<td style="padding:1rem;color:var(--text-light);font-size:0.9rem;">{{$order->createdAt ? $order->createdAt->format('d/m/Y') : 'N/A'}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection