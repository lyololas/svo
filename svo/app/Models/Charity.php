<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use CrudTrait;
    protected $fillable = [
        'name',
        'description',
        'goal_amount',
        'raised_amount',
        'start_date',
        'end_date'
    ];
    public function rules()
{
    return [
        'date_field_name' => 'required|date_format:Y-m-d'
    ];
}
}
