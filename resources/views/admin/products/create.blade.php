@extends('layouts.master')
@section('title','Thêm Sản Phẩm Mới')
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
<a href="{{route('admin.products')}}" style="display:block;padding:0.9rem 1rem;text-align:center;border:1px solid var(--border-light);border-radius:8px;text-decoration:none;color:var(--text-main);">← Quay Lại</a>
</li>
</ul>
</nav>
</div>
</div>
<div class="col" style="flex:1;">
<h1 style="margin:0 0 2rem 0;font-size:2rem;">Thêm Sản Phẩm Mới</h1>
<div style="background:var(--bg-card);border:1px solid var(--border-light);border-radius:12px;padding:3rem;">
<form action="{{route('admin.products.store')}}" method="POST">
@csrf
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Tên Sản Phẩm</label>
<input type="text" name="name" class="formInput" required>
</div>
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Danh Mục</label>
<select name="categoryId" class="formInput" required>
@foreach($categories as $cat)
<option value="{{$cat->id}}">{{$cat->name}}</option>
@endforeach
</select>
</div>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;">
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Giá (VNĐ)</label>
<input type="number" name="price" class="formInput" required>
</div>
<div>
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Số Lượng Trong Kho</label>
<input type="number" name="stock" class="formInput" required>
</div>
</div>
<div style="margin-bottom:1.5rem;">
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Link Hình Ảnh</label>
<input type="url" name="image" class="formInput" required placeholder="https://...">
</div>
<div style="margin-bottom:2rem;">
<label style="display:block;margin-bottom:0.5rem;color:var(--text-light);font-size:0.9rem;">Mô Tả Sản Phẩm</label>
<textarea name="description" class="formInput" rows="5" style="resize:vertical;"></textarea>
</div>
<button type="submit" class="primaryButton w100" style="padding:1rem;">Lưu Sản Phẩm</button>
</form>
</div>
</div>
</div>
@endsection