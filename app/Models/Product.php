<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    protected $fillable = ['categoryId', 'name', 'price', 'stock', 'image', 'description'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'productId');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'productId');
    }
}