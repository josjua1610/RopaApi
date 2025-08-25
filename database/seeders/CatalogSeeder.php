<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{ClothingType, Brand, Size, Color};


class CatalogSeeder extends Seeder
{
public function run(): void
{
foreach (['T-Shirt','Pants','Dress','Hoodie','Jacket'] as $n) ClothingType::firstOrCreate(['name'=>$n]);
foreach (['Nike','Adidas','Zara','H&M','Levi\'s'] as $n) Brand::firstOrCreate(['name'=>$n]);
foreach ([['S','alphanumeric'],['M','alphanumeric'],['L','alphanumeric'],['38','numeric'],['40','numeric']] as [$n,$t]) Size::firstOrCreate(['name'=>$n], ['type'=>$t]);
foreach ([['Black','#000000'],['White','#FFFFFF'],['Red','#FF0000'],['Blue','#0000FF']] as [$n,$h]) Color::firstOrCreate(['name'=>$n], ['hex_code'=>$h]);
}
}