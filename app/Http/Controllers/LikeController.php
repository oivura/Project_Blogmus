<?php
namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        return Like::with(['article', 'user'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
        ]);

        return Like::create($request->all());
    }

    public function show(Like $like)
    {
        return $like->load(['article', 'user']);
    }

    public function destroy(Like $like)
    {
        $like->delete();

        return response()->noContent();
    }
}
