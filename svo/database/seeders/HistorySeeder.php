<?php

use App\Models\History;

public function run()
{
    History::create([
        'title' => 'История 1',
        'description' => 'Описание истории 1...',
        'image' => 'img/history1.jpg',
    ]);

    History::create([
        'title' => 'История 2',
        'description' => 'Описание истории 2...',
        'image' => 'img/history2.jpg',
    ]);

    History::create([
        'title' => 'История 3',
        'description' => 'Описание истории 3...',
        'image' => 'img/history3.jpg',
    ]);
}