<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('articles')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:50',
        ]);

        return Category::create($request->all());
    }

    public function show(Category $category)
    {
        return $category->load('articles');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|required|max:50|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}
