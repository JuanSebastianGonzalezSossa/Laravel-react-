<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->tipo = $request->tipo;
    
        if ($category->save()) {
            return response()->json(['message' => 'Artículo creado correctamente.'], 201);
        } else {
            return response()->json(['message' => 'Hubo un error al crear el artículo.'], 500);
        }
    }    
   
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);
    $category->tipo = $request->tipo;


    if ($category->save()) {
        return response()->json(['message' => 'Artículo actualizado correctamente.'], 200);
    } else {
        return response()->json(['message' => 'Hubo un error al actualizar el artículo.'], 500);
    }
}
public function destroy($id)
{
    Category::destroy($id);
    return response()->json(['message' => 'Artículo eliminado correctamente.'], 200);
}

}
