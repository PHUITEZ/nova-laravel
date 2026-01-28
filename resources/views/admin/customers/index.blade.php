@extends('layouts.master')
@section('title','Quản Lý Khách Hàng')
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
<a href="{{route('admin.dashboard')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Tổng Quan</a>
</li>
<li>
<a href="{{route('admin.products')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Sản Phẩm</a>
</li>
<li>
<a href="{{route('admin.orders')}}" style="display:block;padding:0.9rem 1rem;border-radius:8px;text-decoration:none;color:var(--text-main);transition:all 0.3s;border:1px solid var(--border-light);" onmouseover="this.style.background='var(--bg-body)'" onmouseout="this.style.background='transparent'">Đơn Hàng</a>
</li>
<li>
<a href="{{route('admin.customers')}}" style="display:block;padding:0.9rem 1rem;background:var(--text-main);color:white;border-radius:8px;text-decoration:none;transition:all 0.3s;">Khách Hàng</a>
</li>
</ul>
</nav>
</div>
</div>
<div class="col" style="flex:1;">
<h1 style="margin:0 0 2rem 0;font-size:2rem;">Quản Lý Khách Hàng</h1>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:2rem;">
<div style="overflow-x:auto;">
<table style="width:100%;border-collapse:collapse;">
<thead>
<tr style="border-bottom:2px solid var(--border-light);">
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">ID</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Họ Tên</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Email</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Ngày Tham Gia</th>
<th style="padding:1rem;text-align:left;font-size:0.9rem;color:var(--text-light);font-weight:400;">Hành Động</th>
</tr>
</thead>
<tbody>
@foreach($users as $user)
<tr style="border-bottom:1px solid var(--border-light);">
<td style="padding:1rem;">{{$user->id}}</td>
<td style="padding:1rem;">{{$user->name}}</td>
<td style="padding:1rem;color:var(--text-light);font-size:0.9rem;">{{$user->email}}</td>
<td style="padding:1rem;color:var(--text-light);font-size:0.9rem;">{{$user->createdAt ? $user->createdAt->format('d/m/Y') : 'N/A'}}</td>
<td style="padding:1rem;">
<div style="display:flex;gap:0.5rem;">
<a href="{{route('admin.customers.edit',$user->id)}}" class="qtyBtn" style="width:auto;padding:0 1rem;font-size:0.85rem;text-decoration:none;display:inline-flex;align-items:center;">Sửa</a>
<form action="{{route('admin.customers.destroy',$user->id)}}" method="POST" style="display:inline;" onsubmit="return confirm('Xác Nhận Xóa Khách Hàng Này?')">
@csrf
@method('DELETE')
<button type="submit" class="qtyBtn" style="width:auto;padding:0 1rem;font-size:0.85rem;color:#dc3545;border-color:#dc3545;">Xóa</button>
</form>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div style="margin-top:2rem;display:flex;justify-content:center;">
{{$users->links()}}
</div>
</div>
</div>
@endsection