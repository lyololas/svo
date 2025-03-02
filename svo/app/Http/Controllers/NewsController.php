<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::withCount('likes')
            ->with(['likes' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get()
            ->map(function ($news) {
                return [
                    'id' => $news->id,
                    'title' => $news->title,
                    'description' => $news->description,
                    'image' => $news->image,
                    'likes_count' => $news->likes_count,
                    'is_liked' => $news->likes->isNotEmpty(),
                ];
            });

        return Inertia::render('News/Index', [
            'newsItems' => $newsItems,
        ]);
    }

    public function like(News $news)
    {
        $user = Auth::user();
    
        if ($news->isLikedByUser($user->id)) {
            $news->likes()->where('user_id', $user->id)->delete();
        } else {
            $news->likes()->create(['user_id' => $user->id]);
        }

        return redirect()->back();
    }




}