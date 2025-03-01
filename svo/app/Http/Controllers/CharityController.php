<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Inertia\Inertia;

class CharityController extends Controller
{
    public function index()
    {
        // Paginate with 6 items per page
        $charities = Charity::paginate(6);

        // Transform the charity data to include status
        $charities->getCollection()->transform(function ($charity) {
            $now = now();
            $startDate = \Carbon\Carbon::parse($charity->start_date);
            $endDate = \Carbon\Carbon::parse($charity->end_date);

            if ($now > $endDate) {
                $charity->status = 'Expired';
            } elseif ($charity->raised_amount >= $charity->goal_amount) {
                $charity->status = 'Done';
            } else {
                $charity->status = 'Active';
            }

            return $charity;
        });

        return Inertia::render('CharityView', [
            'charities' => $charities
        ]);
    }
}