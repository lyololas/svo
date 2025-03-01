<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopItem;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $shopItems = ShopItem::all();

        return Inertia::render('Shop', [
            'user' => $user,
            'shopItems' => $shopItems,
        ]);
    }

    public function purchase(Request $request)
    {
        $user = Auth::user();
        $item = ShopItem::find($request->item_id);

        if (!$item || $item->stocks <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Товар закончился.',
            ], 400);
        }

        if ($user->coins < $item->price) {
            return response()->json([
                'success' => false,
                'message' => 'Недостаточно монет для покупки.',
            ], 400);
        }

    
        $user->coins -= $item->price;
        $user->save();

        $item->stocks -= 1;
        $item->save();

        $code = Str::upper(Str::random(8));

        return response()->json([
            'success' => true,
            'message' => 'Покупка успешна!',
            'code' => $code, 
        ]);
    }
}