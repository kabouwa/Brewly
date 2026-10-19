<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['App' => 'Brewly'];
});

require __DIR__.'/auth.php';
