<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->save();
        return redirect(route('posts.index', absolute: false));
    }

    public function index(Request $request)
    {
        $posts = Post::all(); 
        return Inertia::render('Posts', [
            'posts' => $posts
        ]);
    }

    public function show($id) {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        
        return Inertia::render('PostShow', [
            'post' => $post,
            'comments' => $comments 
        ]);
    }
    

}
