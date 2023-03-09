<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
 
    public function index()
    {
        $articles = Article::join('categories', 'articles.categoria_id', '=', 'categories.id')
                    ->select('articles.*', 'categories.tipo as categoria_tipo')
                    ->get();
        return $articles;
    }

    public function store(Request $request)
    {
        $article = new Article();
        $article->titulo = $request->titulo;
        $article->slug = $request->slug;
        $article->texto_corto = $request->texto_corto;
        $article->texto_largo = $request->texto_largo;
        $article->img_url = $request->img_url;
        $article->categoria_id = $request->categoria_id;
    
        if ($article->save()) {
            return response()->json(['message' => 'Artículo creado correctamente.'], 201);
        } else {
            return response()->json(['message' => 'Hubo un error al crear el artículo.'], 500);
        }
    }    
   
    public function show($id)
    {
        $article = Article::find($id);
        return $article;
    }

    public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);
    $article->titulo = $request->titulo;
    $article->slug = $request->slug;
    $article->texto_corto = $request->texto_corto;
    $article->texto_largo = $request->texto_largo;
    $article->img_url = $request->img_url;
    $article->categoria_id = $request->categoria_id;

    if ($article->save()) {
        return $article;
    } else {
        return response()->json(['message' => 'Hubo un error al actualizar el artículo.'], 500);
    }
}
public function destroy($id)
{
    Article::destroy($id);
    return response()->json(['message' => 'Artículo eliminado correctamente.'], 200);
}

}
