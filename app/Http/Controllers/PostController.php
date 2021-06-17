<?php

namespace App\Http\Controllers;

use App\LikePost;
use Illuminate\Http\Request;
use App\Post;
use App\HeadTag;
use App\UserLikePost;
use Auth;

class PostController extends Controller
{
    public function index(){
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->
        select('posts.*', 'users.name AS user_name')->orderBy('id', 'desc')->paginate(20);

        # get head tags
        $head_tags = HeadTag::where('type', 'list_post')->first();
        return view('new.post', compact('posts', 'head_tags'));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->join('users', 'users.id', '=', 'posts.user_id')->
        select('posts.*', 'users.name AS user_name')->first();
        $author = $post->user_name;

        # add view
        $post = $this->update($post->id);
        $user_login = Auth::user() ? Auth::user()->id : 0;
        $is_like = in_array($user_login, $post->users_like->pluck('id')->toArray()) ? 1 : 0;

        # get head tags
        $head_tags = HeadTag::where('type', 'post')->where('type_id', $post->id)->first();
        return view('new.post-content', compact('post', 'author', 'user_login', 'is_like', 'head_tags'));
    }

    public function terms_of_services($id = 1){
        $content = Post::find($id);
        $head_tags = HeadTag::where('type', 'post')->where('type_id', $id)->first();
        return view('new.blog-content2', compact('content', 'head_tags'));
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

    public function like_post(Request $request) {
        $post_id = $request->post_id;
        $user_id = $request->user_id;
        $post = Post::find($post_id);
        $status = "Like";
        if (in_array($user_id, $post->users_like->pluck('id')->toArray())){
            LikePost::where('post_id', $post_id)->decrement('like_count');
            UserLikePost::where('user_id', $user_id)->where('post_id', $post_id)->delete();
            $status = "Dislike";
        } else{
            LikePost::where('post_id', $post_id)->increment('like_count');
            $user_like_post = new UserLikePost();
            $user_like_post->post_id = $post_id;
            $user_like_post->user_id = $user_id;
            $user_like_post->save();
        }
        return response()->json([
            'bool'=> $status
        ]);
    }
}
