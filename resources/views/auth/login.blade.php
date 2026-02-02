@extends('layouts.master')
@section('title', 'Đăng Nhập')
@section('content')
    <div class="flexCenter" style="min-height:70vh;">
        <div class="glassContainer animateFade" style="padding:3rem;width:100%;max-width:450px;">
            <h2 class="textCenter mb4">Đăng Nhập</h2>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="formGroup mb3">
                    <label class="formLabel mb1" style="display:block;">Email</label>
                    <input type="email" name="email" class="formInput" required placeholder="name@example.com">
                    @error('email')<span style="color:var(--primary);font-size:0.85rem;">{{$message}}</span>@enderror
                </div>
                <div class="formGroup mb4">
                    <label class="formLabel mb1" style="display:block;">Mật Khẩu</label>
                    <input type="password" name="password" class="formInput" required placeholder="••••••••">
                </div>
                <button type="submit" class="primaryButton w100 textCenter">Đăng Nhập</button>
            </form>
            <p class="textCenter mt4">
                Chưa Có Tài Khoản? <a href="{{route('register')}}" style="color:var(--primary);">Đăng Ký Ngay</a>
            </p>
        </div>
    </div>
@endsection