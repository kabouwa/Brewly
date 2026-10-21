<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Brewly API is running.',
        'data' => [
            'name' => 'Brewly',
            'version' => '1.0.0',
        ],
    ]);
});

// Generated authentication
// require __DIR__.'/auth.php';
