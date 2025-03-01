<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Inertia\Inertia;

class CharityController extends Controller
{
    public function index()
    {
        return Inertia::render('List', [
            'charities' => Charity::all()
        ]);
    }

    public function show(Charity $charity)
    {
        return Inertia::render('CharityView', [
            'charity' => $charity
        ]);
    }
}