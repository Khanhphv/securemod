<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::sortByDesc('id')->paginate(20)->get();
        return view('new.post.index', compact('posts'));
    }

    public function show($id){
        $post = Post::find($id);
        return view('new.post.show', compact('post'));
    }
}
