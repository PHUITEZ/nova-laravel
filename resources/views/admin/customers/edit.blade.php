@extends('layouts.master')
@section('title','Chỉnh Sửa Khách Hàng')
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
<a href="{{route('admin.customers')}}" style="display:block;padding:0.9rem 1rem;text-align:center;border:1px solid var(--border-light);border-radius:8px;text-decoration:none;color:var(--text-main);">← Quay Lại</a>
</li>
</ul>
</nav>
</div>
</div>
<div class="col" style="flex:1;">
<h1 style="margin:0 0 2rem 0;font-size:2rem;">Chỉnh Sửa Khách Hàng</h1>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:3rem;">
<form action="{{route('admin.customers.update',$user->id)}}" method="POST">
@csrf
@method('PUT')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Họ Tên</label>
<input type="text" name="name" class="formInput" value="{{$user->name}}" required>
</div>
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Email</label>
<input type="email" name="email" class="formInput" value="{{$user->email}}" required>
</div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem;">
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Số Điện Thoại</label>
<input type="text" name="phone" class="formInput" value="{{$user->phone}}">
</div>
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Địa Chỉ</label>
<input type="text" name="address" class="formInput" value="{{$user->address}}">
</div>
</div>
<button type="submit" class="primaryButton w100" style="padding:1rem;">Cập Nhật Khách Hàng</button>
</form>
</div>
</div>
</div>
@endsection