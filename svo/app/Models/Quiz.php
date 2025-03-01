<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'reward_coins',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function users()
{
    return $this->belongsToMany(User::class)->withPivot('completed_at');
}
}