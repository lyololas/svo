<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\News;

class DashboardController extends Controller
{
    public function index()
    {
        $newsItems = News::latest()->take(3)->get();

        return Inertia::render('Dashboard', [
            'newsItems' => $newsItems,
        ]);
    }
}