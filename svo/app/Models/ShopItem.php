<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
class ShopItem extends Model
{
    use HasFactory;
    use CrudTrait;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stocks',
    ];
}
