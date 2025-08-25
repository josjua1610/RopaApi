<?php

namespace App\Http\Controllers;


use App\Models\{Cloth, ClothImage};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ClothController extends Controller
{
public function index(Request $request)
{
///$q = Cloth::with(['type','brand','size','color','images']);
$q = Cloth::query();
if ($s = $request->get('search')) $q->where('name', 'like', "%{$s}%");
if ($id = $request->get('type_id')) $q->where('type_id', $id);
if ($id = $request->get('brand_id')) $q->where('brand_id', $id);
if ($g = $request->get('gender')) $q->where('gender', $g);
return $q->orderByDesc('id')->paginate(20);
}


public function show(Cloth $cloth)
{
return $cloth->load(['type','brand','size','color','images']);
}


public function store(Request $request)
{
$data = $request->validate([
'name' => ['required','string','max:255'],
'type_id' => ['required','exists:clothing_types,id'],
'brand_id' => ['required','exists:brands,id'],
'size_id' => ['required','exists:sizes,id'],
'color_id' => ['required','exists:colors,id'],
'gender' => ['required', Rule::in(['male','female','unisex'])],
'purchase_price' => ['required','numeric','min:0'],
'sale_price' => ['required','numeric','min:0'],
'images' => ['nullable','array'],
'images.*' => ['file','image','mimes:jpg,jpeg,png,webp','max:5120'],
'primary_index' => ['nullable','integer','min:0'],
]);


return DB::transaction(function() use ($data, $request) {
$cloth = Cloth::create($data);


foreach ($request->file('images', []) as $idx => $file) {
$path = $file->store('products', 'public');
$cloth->images()->create([
'path' => $path,
'is_primary' => isset($data['primary_index']) && (int)$data['primary_index'] === $idx,
]);
}
if ($cloth->images()->exists() && !$cloth->images()->where('is_primary', true)->exists()) {
$cloth->images()->oldest()->first()?->update(['is_primary' => true]);
}


return $cloth->load(['type','brand','size','color','images']);
});
}


public function update(Request $request, Cloth $clothes)
{
    $data = $request->validate([
        'name'           => 'required|string',
        'type_id'        => 'required|exists:clothing_types,id',
        'brand_id'       => 'required|exists:brands,id',
        'size_id'        => 'required|exists:sizes,id',
        'color_id'       => 'required|exists:colors,id',
        'gender'         => 'required|string',
        'purchase_price' => 'required|numeric',
        'sale_price'     => 'required|numeric',
    ]);

    $clothes->update($data);

    return response()->json([
        'message' => 'Producto actualizado correctamente',
        'data'    => $clothes
    ]);
}

public function destroy(Cloth $clothes)
{
    $clothes->delete();

    return response()->json([
        'message' => 'Producto eliminado correctamente'
    ]);
}
public function findById($id)
{
    if (!ctype_digit((string)$id)) {
        return response()->json(['message' => 'ID inválido'], 422);
    }

    $cloth = \App\Models\Cloth::with(['type','brand','size','color','images','primaryImage'])
        ->find($id);

    if (!$cloth) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    return response()->json($cloth);
}

}