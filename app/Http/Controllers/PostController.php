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

        return PostsResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with('author')->findOrFail($id);

        return new PostDetailResource($post);
    }

   
}
