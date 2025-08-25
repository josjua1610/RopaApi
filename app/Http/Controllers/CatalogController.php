<?php
namespace App\Http\Controllers;

use App\Models\{ClothingType, Brand, Size, Color};
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function types(){ return ClothingType::orderBy('name')->get(); }
    public function brands(){ return Brand::orderBy('name')->get(); }
    public function sizes(){ return Size::orderBy('name')->get(); }
    public function colors(){ return Color::orderBy('name')->get(); }

    public function storeType(Request $r){ $d=$r->validate(['name'=>'required|unique:clothing_types']); return ClothingType::create($d); }
    public function storeBrand(Request $r){ $d=$r->validate(['name'=>'required|unique:brands']); return Brand::create($d); }
    public function storeSize(Request $r){ $d=$r->validate(['name'=>'required|unique:sizes','type'=>'nullable']); return Size::create($d); }
    public function storeColor(Request $r){ $d=$r->validate(['name'=>'required|unique:colors','hex_code'=>'nullable']); return Color::create($d); }
}