<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function postIndex() {
    $posts = Post::all();
    return view('pages.post-index', compact('posts'));
  }
}
