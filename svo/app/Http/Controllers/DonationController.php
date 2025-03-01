<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function store(Request $request, Charity $charity)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to make a donation.');
        }

        // Validate the donation amount
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Ensure the donation does not exceed the charity's goal
        if ($charity->raised_amount + $validated['amount'] > $charity->goal_amount) {
            return back()->with('error', 'The donation amount exceeds the charity\'s goal.');
        }

        // Update the charity's raised amount
        $charity->increment('raised_amount', $validated['amount']);

        // Award coins to the user (if applicable)
        $user = Auth::user();
        $coinsEarned = floor($validated['amount'] / 10); // Example: 1 coin for every 10 rubles
        $user->increment('coins', $coinsEarned);

        return back()->with('success', 'Thank you for your donation!');
    }
}