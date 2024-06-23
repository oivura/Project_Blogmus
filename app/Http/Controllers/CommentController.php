<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with(['article', 'user'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required',
        ]);

        return Comment::create($request->all());
    }

    public function show(Comment $comment)
    {
        return $comment->load(['article', 'user']);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'sometimes|required',
        ]);

        $comment->update($request->all());

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}

