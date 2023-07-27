<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use App\Models\Post;
use Illuminate\Http\Request;

class PemilikComment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = auth()->user()->id; 
        $comment = Comment::findOrFail($request->id); 

        if($comment->user_id != $currentUser){
            return response()->json(['message' => 'unauthorize'],404);
        }

        return $next($request);
    }
}
