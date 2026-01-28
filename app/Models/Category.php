<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model{
use HasFactory;
const CREATED_AT='createdAt';
const UPDATED_AT='updatedAt';
protected $fillable=['name','slug','image'];
public function products(){
return $this->hasMany(Product::class,'categoryId');
}
}