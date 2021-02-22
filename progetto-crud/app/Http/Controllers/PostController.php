<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function postIndex() {
    // $posts = Post::all();
    $posts = Post::orderBy('id', 'desc') -> get();
    return view('pages.post-index', compact('posts'));
  }

  // function post create
  public function postCreate(Request $request) {
    // return response() -> json($request -> all(), 200); |--->test

    $post = Post::create($request -> all());
    return response() -> json($post, 200);
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
