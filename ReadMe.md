# 🛍️ NOVA FASHION - Website Bán Hàng & Quản Lý Kho

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)

Đồ án môn học: **Xây dựng Website Thương mại điện tử với Laravel**
Đây là hệ thống bán hàng thời trang trực tuyến với đầy đủ tính năng dành cho Khách hàng và trang Quản trị (Admin Dashboard) mạnh mẽ.

---

## 🚀 Tính Năng Chính

### 👤 Phân hệ Khách Hàng (Client)
- Xem danh sách sản phẩm, lọc theo danh mục, giá.
- Tìm kiếm sản phẩm.
- Thêm vào giỏ hàng, cập nhật số lượng.
- Đặt hàng (Checkout).

### 🛡️ Phân hệ Quản Trị (Admin Panel)
- **Dashboard:** Thống kê doanh thu, số lượng đơn hàng, sản phẩm tồn kho.
- **Quản lý Sản phẩm:**
  - Thêm, Sửa, Xóa sản phẩm.
  - **Upload hình ảnh sản phẩm** trực tiếp.
  - Quản lý tồn kho (Inventory).
- **Quản lý Đơn hàng:** Xem chi tiết đơn hàng, cập nhật trạng thái đơn.
- **Quản lý Khách hàng:** Xem danh sách người dùng.

---

## 🛠️ Yêu Cầu Hệ Thống
- PHP >= 8.1
- Composer
- Node.js & NPM (tùy chọn nếu build assets)

---

## ⚡ Hướng Dẫn Cài Đặt (Chạy Localhost)

### Bước 1: Cài đặt thư viện
- composer install

### Bước 2: Cấu hình môi trường
- cp .env.example .env
- php artisan key:generate

### Bước 3: Cấu hình Database (SQLite)
- Mở file .env xóa các dòng DB_HOST, DB_PORT... và sửa thành: DB_CONNECTION=sqlite
- Chạy lệnh tạo database và dữ liệu mẫu:
  - touch database/database.sqlite
  - php artisan migrate:fresh --seed
 
### Bước 4: Cấu hình Upload Ảnh
- php artisan storage:link

### Bước 5: Khởi chạy Server
- php artisan serve
