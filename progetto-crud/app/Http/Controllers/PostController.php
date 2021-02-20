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
  public function postUpdate(Request $request, $id) {
    $post = Post::findOrFail($id);
    $post -> update($request -> all());
    return response() -> json('post ' . $id . ' updated' , 200);
  }
  public function postDestroy($id) {
    $post = Post::findOrFail($id);
    $post -> delete();
    return response() -> json('post ' . $id . ' destroyed' , 200);
  }
}
