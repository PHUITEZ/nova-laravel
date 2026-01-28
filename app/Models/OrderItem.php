<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrderItem extends Model{
use HasFactory;
const CREATED_AT='createdAt';
const UPDATED_AT='updatedAt';
protected $fillable=['orderId','productId','quantity','price'];
public function order(){
return $this->belongsTo(Order::class,'orderId');
}
public function product(){
return $this->belongsTo(Product::class,'productId');
}
}