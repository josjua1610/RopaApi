<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ClothImage extends Model
{
protected $fillable = ['cloth_id','path','is_primary'];
public function cloth(){ return $this->belongsTo(Cloth::class); }
protected $appends = ['url'];
public function getUrlAttribute(){ return asset('storage/'.$this->path); }
}