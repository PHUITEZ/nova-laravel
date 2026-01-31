<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>@yield('title') | NOVA Fashion</title>
<link rel="stylesheet" href="{{asset('css/glass.css')}}">
<style>
body { opacity: 0; animation: fadeInBody 1s ease forwards; }
@keyframes fadeInBody { to { opacity: 1; } }
</style>
</head>
<body>
<div class="mobileMenuOverlay" id="mobileOverlay"></div>
<div class="mobileMenu" id="mobileMenu">
<button class="mobileMenuClose" id="mobileMenuClose">&times;</button>
<ul>
<li><a href="{{route('home')}}">Trang Chủ</a></li>
<li><a href="{{route('products.index')}}">Sản Phẩm</a></li>
<li><a href="{{route('cart.index')}}">Giỏ Hàng</a></li>
@auth
<li><a href="{{auth()->user()->role==='admin'?route('admin.dashboard'):'#'}}">{{auth()->user()->name}}</a></li>
<li><a href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">Đăng Xuất</a></li>
<form id="logoutForm" action="{{route('logout')}}" method="POST" style="display:none;">@csrf</form>
@else
<li><a href="{{route('login')}}">Đăng Nhập</a></li>
<li><a href="{{route('register')}}">Đăng Ký</a></li>
@endauth
</ul>
</div>
<header class="mainHeader">
<a href="{{route('home')}}" class="navLink noDecor" style="display:flex;align-items:center;gap:0.5rem;white-space:nowrap;">
<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
<h1 style="margin:0;font-size:1.5rem;letter-spacing:-0.05em;color:var(--textMain);font-weight:400;">NOVA</h1>
</a>
<form action="{{route('products.index')}}" method="GET" style="flex:1;max-width:600px;margin:0 2rem;" class="desktopSearch">
<input type="text" name="search" placeholder="Tìm Kiếm Sản Phẩm..." style="width:100%;padding:0.7rem 1rem;border:1px solid var(--border-light);border-radius:50px;background:var(--bg-body);font-family:inherit;font-size:0.9rem;">
</form>
<div class="hamburger" id="hamburger">
<span></span>
<span></span>
<span></span>
</div>
<div class="desktopNav" style="display:flex;align-items:center;gap:2rem;">
<nav class="navigation">
<ul class="navMenu" style="gap:2rem;">
<li><a href="{{route('home')}}" class="navLink {{request()->routeIs('home') ? 'active' : ''}}">Trang Chủ</a></li>
<li><a href="{{route('products.index')}}" class="navLink {{request()->routeIs('products.*') ? 'active' : ''}}">Sản Phẩm</a></li>
<li><a href="{{route('cart.index')}}" class="navLink {{request()->routeIs('cart.*') ? 'active' : ''}}">Giỏ Hàng</a></li>
</ul>
</nav>
<div style="display:flex;align-items:center;gap:1rem;white-space:nowrap;">
@auth
<a href="{{auth()->user()->role==='admin'?route('admin.dashboard'):'#'}}" class="primaryButton" style="padding:0.6rem 1.2rem;font-size:0.85rem;">
{{auth()->user()->name}}
</a>
<form action="{{route('logout')}}" method="POST" style="display:inline;">
@csrf
<button type="submit" class="navLink" style="background:none;border:none;cursor:pointer;font-family:inherit;padding:0;">Đăng Xuất</button>
</form>
@else
<a href="{{route('login')}}" class="navLink">Đăng Nhập</a>
<a href="{{route('register')}}" class="primaryButton" style="padding:0.6rem 1.2rem;font-size:0.85rem;">Đăng Ký</a>
@endauth
</div>
</div>
</header>
<script>
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
const mobileOverlay = document.getElementById('mobileOverlay');
const mobileMenuClose = document.getElementById('mobileMenuClose');
hamburger.addEventListener('click', () => {
mobileMenu.classList.add('active');
mobileOverlay.classList.add('active');
});
mobileMenuClose.addEventListener('click', () => {
mobileMenu.classList.remove('active');
mobileOverlay.classList.remove('active');
});
mobileOverlay.addEventListener('click', () => {
mobileMenu.classList.remove('active');
mobileOverlay.classList.remove('active');
});
</script>
<main class="mainContent" style="margin:2rem auto;padding:0 2rem;width:100%;max-width:1400px;flex:1;">
@if(session('success'))
<div class="toastNotification">
{{session('success')}}
</div>
<script>
setTimeout(function(){
const toast = document.querySelector('.toastNotification');
if(toast) {
toast.classList.add('hiding');
setTimeout(() => toast.remove(), 300);
}
}, 3000);
</script>
@endif
@if(session('error'))
<div class="toastNotification" style="background: #e74c3c;">
{{session('error')}}
</div>
<script>
setTimeout(function(){
const toast = document.querySelectorAll('.toastNotification')[document.querySelectorAll('.toastNotification').length - 1];
if(toast) {
toast.classList.add('hiding');
setTimeout(() => toast.remove(), 300);
}
}, 3000);
</script>
@endif
@yield('content')
</main>
<footer class="mainFooter">
<div class="row" style="max-width:1200px;margin:0 auto 3rem;text-align:left;">
<div class="col">
<h4 class="mb2">Về NOVA</h4>
<p style="color:var(--text-light);font-size:0.9rem;">Thương Hiệu Thời Trang Tối Giản Dành Cho Người Hiện Đại! Chúng Tôi Cam Kết Mang Đến Những Sản Phẩm Chất Lượng Cao Với Mức Giá Hợp Lý!</p>
</div>
<div class="col">
<h4 class="mb2">Liên Kết Nhanh</h4>
<div style="display:flex;flex-direction:column;gap:0.5rem;">
<a href="{{route('home')}}" class="footerLink" style="text-align:left;">Trang Chủ</a>
<a href="{{route('products.index')}}" class="footerLink" style="text-align:left;">Sản Phẩm</a>
<a href="#" class="footerLink" style="text-align:left;">Về Chúng Tôi</a>
<a href="#" class="footerLink" style="text-align:left;">Liên Hệ</a>
</div>
</div>
<div class="col">
<h4 class="mb2">Chính Sách</h4>
<div style="display:flex;flex-direction:column;gap:0.5rem;">
<a href="#" class="footerLink" style="text-align:left;">Chính Sách Bảo Mật</a>
<a href="#" class="footerLink" style="text-align:left;">Điều Khoản Sử Dụng</a>
<a href="#" class="footerLink" style="text-align:left;">Chính Sách Đổi Trả</a>
<a href="#" class="footerLink" style="text-align:left;">Hướng Dẫn Mua Hàng</a>
</div>
</div>
<div class="col">
<h4 class="mb2">Kết Nối</h4>
<p style="color:var(--text-light);font-size:0.9rem;">Đăng Ký Nhận Bản Tin Để Không Bỏ Lỡ Những Ưu Đãi Mới Nhất</p>
</div>
</div>
<div style="border-top:1px solid var(--border-light);padding-top:2rem;">
<p style="margin:0;color:var(--textLight);font-size:0.9rem;">&copy; 2026 NOVA Fashion</p>
</div>
</footer>
</body>
</html>