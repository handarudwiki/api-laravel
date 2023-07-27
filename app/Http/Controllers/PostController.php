<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;



class PostController extends Controller
{
    

    public function index()
    {
        $posts = Post::all();

        return PostsResource::collection($posts->loadMissing('author'));
    }

    public function show($id)
    {
        $post = Post::with('author')->findOrFail($id);

        return new PostDetailResource($post);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'news_content' => 'required',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('post-images');
        }

        $validate['user_id'] = auth()->user()->id;


        $post = Post::create($validate);

        return response()->json($post);
    }

    public function update(Request $request)
    {

        $validate = $request->validate([
            'title' => 'required',
            'news_content' => 'required',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')){
            $validate['image'] = $request->file('image')->store('post-images');
        }

        $validate['user_id'] = auth()->user()->id;

        $post = Post::findOrFail($request->id);
        $post->update($validate);

        return response()->json($post);
    }

    public function destroy(Request $request)
    {
       $post = Post::findOrFail($request->id);
    
       $post->delete();
    
       return response()->json($post);
    }
}


