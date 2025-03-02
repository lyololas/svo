<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {

        $historyItems = History::latest()->get();


        return Inertia::render('History/Index', [
            'historyItems' => $historyItems,
        ]);
    }
}