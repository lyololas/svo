<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_item_id',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shopItem()
    {
        return $this->belongsTo(ShopItem::class);
    }
}