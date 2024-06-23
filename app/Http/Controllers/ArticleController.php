<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::with(['user', 'comments', 'tags', 'categories', 'likes'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        return Article::create($request->all());
    }

    public function show(Article $article)
    {
        return $article->load(['user', 'comments', 'tags', 'categories', 'likes']);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'sometimes|required|max:255',
            'content' => 'sometimes|required',
        ]);

        $article->update($request->all());

        return $article;
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->noContent();
    }
}