<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        return Inertia::render('Posts', [
            'posts' => $posts,
        ]);
    }

    /**
     * Display a specific post with its comments.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;

        return Inertia::render('PostShow', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * Store a newly created post.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('posts', $imageName, 'public');
            $validatedData['image'] = $imagePath;
        }

     
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->user_id = Auth::id();
        $post->image = $validatedData['image'] ?? null; 
        $post->save();

        
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Store a new comment for a post.
     */
    public function storeComment(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $comment = new Comments();
        $comment->content = $validatedData['content'];
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('post.show', $post->id)->with('success', 'Comment added successfully!');
    }
}