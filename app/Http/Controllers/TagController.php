<?php 

 namespace App\Http\Controllers;

 use App\Models\Tag;
 use Illuminate\Http\Request;

 class TagController extends Controller
 {
     public function index()
     {
         return Tag::with('articles')->get();
     }

     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|unique:tags|max:50',
         ]);

         return Tag::create($request->all());
     }

     public function show(Tag $tag)
     {
         return $tag->load('articles');
     }
 
     public function update(Request $request, Tag $tag)
     {
         $request->validate([
             'name' => 'sometimes|required|max:50|unique:tags,name,' . $tag->id,
         ]);
 
         $tag->update($request->all());
 
         return $tag;
     }
 
     public function destroy(Tag $tag)
     {
         $tag->delete();
 
         return response()->noContent();
     }
 }
 

