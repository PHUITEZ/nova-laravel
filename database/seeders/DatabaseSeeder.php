<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder{
public function run():void{
$now = now();
User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>Hash::make('password'),'role'=>'admin','address'=>'123 Đường Lê Lợi, Quận 1, TP.HCM','phone'=>'0901234567','createdAt'=>$now,'updatedAt'=>$now]);
User::create(['name'=>'Nguyen Van Phu','email'=>'user@example.com','password'=>Hash::make('password'),'role'=>'user','address'=>'456 Đường Nguyễn Huệ, Quận 1, TP.HCM','phone'=>'0909876543','createdAt'=>$now,'updatedAt'=>$now]);
$cat1=Category::create(['name'=>'Thời Trang Nam','slug'=>'thoiTrangNam','image'=>'https://images.unsplash.com/photo-1490114538077-0a7f8cb49891?q=80&w=2070&auto=format&fit=crop','createdAt'=>$now,'updatedAt'=>$now]);
$cat2=Category::create(['name'=>'Thời Trang Nữ','slug'=>'thoiTrangNu','image'=>'https://images.unsplash.com/photo-1525845859779-54d477ff291f?q=80&w=1974&auto=format&fit=crop','createdAt'=>$now,'updatedAt'=>$now]);
$cat3=Category::create(['name'=>'Phụ Kiện','slug'=>'phuKien','image'=>'https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=2070&auto=format&fit=crop','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat1->id,'name'=>'Áo Thun Basic','price'=>150000,'stock'=>50,'image'=>'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=2080&auto=format&fit=crop','description'=>'Áo Thun Cotton 100% Thoáng Mát.','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat1->id,'name'=>'Quần Jean Slim Fit','price'=>450000,'stock'=>30,'image'=>'https://images.unsplash.com/photo-1542272454315-4c01d7abdf4a?q=80&w=2070&auto=format&fit=crop','description'=>'Quần Jean Form Ôm Thời Trang.','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat2->id,'name'=>'Đầm Voan Hoa','price'=>350000,'stock'=>20,'image'=>'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?q=80&w=1946&auto=format&fit=crop','description'=>'Đầm Voan Hoa Nhẹ Nhàng Nữ Tính.','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat2->id,'name'=>'Chân Váy Xếp Ly','price'=>250000,'stock'=>40,'image'=>'https://images.unsplash.com/photo-1583496661160-fb5886a0aaaa?q=80&w=1964&auto=format&fit=crop','description'=>'Chân Váy Xếp Ly Năng Động.','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat3->id,'name'=>'Mũ Lưỡi Trai','price'=>120000,'stock'=>100,'image'=>'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&auto=format&fit=crop','description'=>'Mũ Lưỡi Trai Phong Cách.','createdAt'=>$now,'updatedAt'=>$now]);
Product::create(['categoryId'=>$cat3->id,'name'=>'Túi Tote Canvas','price'=>90000,'stock'=>80,'image'=>'https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=1958&auto=format&fit=crop','description'=>'Túi Tote Vải Canvas Bền Đẹp.','createdAt'=>$now,'updatedAt'=>$now]);
}
}