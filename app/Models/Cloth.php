<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{ClothingType, Brand, Size, Color, ClothImage};
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- ESTE es el correcto


class Cloth extends Model
{
use HasFactory;
protected $table = 'clothes';
protected $fillable = [
    'name','type_id','brand_id','size_id','color_id',
    'gender','purchase_price','sale_price','stock'  // <--- agregado
];

public function type() { return $this->belongsTo(ClothingType::class, 'type_id'); }
public function brand() { return $this->belongsTo(Brand::class, 'brand_id'); }
public function size() { return $this->belongsTo(Size::class, 'size_id'); }
public function color() { return $this->belongsTo(Color::class, 'color_id'); }
public function images(){ return $this->hasMany(ClothImage::class); }  
public function primaryImage(){ return $this->hasOne(ClothImage::class)->where('is_primary', true); }
}
