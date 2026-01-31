<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class CartItem extends Model
{
    use HasFactory;
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    protected $fillable = ['cartId', 'productId', 'quantity'];
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cartId');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}