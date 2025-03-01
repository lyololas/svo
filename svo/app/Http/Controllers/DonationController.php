<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:1000000',
        ]);

        
        $charity = Charity::firstOrFail();
        
        $charity->increment('raised_amount', $validated['amount']);
        
       
        $user = Auth::user();
        $user->increment('coins', $validated['amount'] / 10);

    
        return redirect()->back()->with([
            'charity' => $charity->fresh(),
            'user' => $user->fresh()
        ]);
    }
}