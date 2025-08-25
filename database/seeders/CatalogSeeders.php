<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{ClothingType, Brand, Size, Color};

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Camiseta','Pantalón','Vestido','Sudadera','Chaqueta'] as $n) ClothingType::firstOrCreate(['name'=>$n]);
        foreach (['Nike','Adidas','Zara','H&M','Levi\'s'] as $n) Brand::firstOrCreate(['name'=>$n]);
        foreach ([['S','alfanumérica'],['M','alfanumérica'],['L','alfanumérica'],['38','numérica'],['40','numérica']] as [$n,$t]) Size::firstOrCreate(['name'=>$n], ['type'=>$t]);
        foreach ([['Negro','#000000'],['Blanco','#FFFFFF'],['Rojo','#FF0000'],['Azul','#0000FF']] as [$n,$h]) Color::firstOrCreate(['name'=>$n], ['hex_code'=>$h]);
    }
}