<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->
        select('posts.*', 'users.name AS user_name')->orderBy('id')->paginate(20);
        return view('new.post', compact('posts'));
    }

    public function show($id){
        $post = Post::join('users', 'users.id', '=', 'posts.user_id')->
        select('posts.*', 'users.name AS user_name')->find($id);
        $author = $post->user_name;

        # add view
        $post = $this->update($post->id);
        return view('new.post-content', compact('post', 'author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $post = Post::findOrFail($id);
        $post->view = $post->view + 1;
        $post->save();
        return $post;
    }
}
