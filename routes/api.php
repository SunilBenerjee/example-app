<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/post/{title}', function ($title) {
    return $post = Post::where('title', 'like', '%' . $title . '%')->get();
});

