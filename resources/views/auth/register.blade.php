@extends('layouts.master')
@section('title', 'Đăng Ký')
@section('content')
    <div class="flexCenter" style="min-height:70vh;">
        <div class="glassContainer animateFade" style="padding:3rem;width:100%;max-width:550px;">
            <h2 class="textCenter mb4">Tạo Tài Khoản</h2>
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="formGroup mb3">
                    <label class="formLabel mb1" style="display:block;">Họ Tên Đầy Đủ</label>
                    <input type="text" name="name" class="formInput" required placeholder="Nguyễn Văn A">
                </div>
                <div class="formGroup mb3">
                    <label class="formLabel mb1" style="display:block;">Email</label>
                    <input type="email" name="email" class="formInput" required placeholder="name@example.com">
                </div>
                <div class="row mb4" style="gap:1rem;">
                    <div class="col" style="padding:0;">
                        <label class="formLabel mb1" style="display:block;">Mật Khẩu</label>
                        <input type="password" name="password" class="formInput" required>
                    </div>
                    <div class="col" style="padding:0;">
                        <label class="formLabel mb1" style="display:block;">Xác Nhận</label>
                        <input type="password" name="password_confirmation" class="formInput" required>
                    </div>
                </div>
                <button type="submit" class="primaryButton w100 textCenter">Đăng Ký</button>
            </form>
            <p class="textCenter mt4">
                Đã Có Tài Khoản? <a href="{{route('login')}}" style="color:var(--primary);">Đăng Nhập</a>
            </p>
        </div>
    </div>
@endsection