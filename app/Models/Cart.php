<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Cart extends Model{
use HasFactory;
const CREATED_AT='createdAt';
const UPDATED_AT='updatedAt';
protected $fillable=['userId','sessionId'];
public function user(){
return $this->belongsTo(User::class,'userId');
}
public function cartItems(){
return $this->hasMany(CartItem::class,'cartId');
}
}