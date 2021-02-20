<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PostController@postIndex')
      -> name('post-index');

Route::post('/post/update/{id}', 'PostController@postUpdate')
      -> name('post-update');

Route::get('/post/destroy/{id}', 'PostController@postDestroy')
      -> name('post-destroy');
