<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id')->paginate(20);
        return view('new.post', compact('posts'));
    }

    public function show($id){
        $post = Post::join('users', 'users.id', '=', 'posts.user_id')->
        select('posts.*', 'users.name AS user_name')->find($id);
        return view('new.post-content', compact('post'));
    }
}
