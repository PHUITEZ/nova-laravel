<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model{
use HasFactory;
const CREATED_AT='createdAt';
const UPDATED_AT='updatedAt';
protected $fillable=['userId','status','total','address','phone'];
public function user(){
return $this->belongsTo(User::class,'userId');
}
public function orderItems(){
return $this->hasMany(OrderItem::class,'orderId');
}
}