<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\LikePost;
use App\HeadTag;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostsRequest;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')->
            select('posts.*', 'users.name AS user_name')->
            orderBy('id', 'desc')->paginate(20);
        return view('admin.post.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get()->pluck('name', 'id');
        return view('admin.post.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostsRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->thumbnail = $request->thumbnail;
        $post->view = 0;
        $post->save();
        $post->tag()->sync((array)$request->input('tag'));

        # init like post
        $like_post = new LikePost();
        $like_post->post_id = $post->id;
        $like_post->save();

        # add head tasg
        $head_tags = new HeadTag();
        $head_tags->type = 'post';
        $head_tags->type_id = $post->id;
        $head_tags->head_title = $request->header_title;
        $head_tags->head_description = $request->header_description;
        $head_tags->save();

        return redirect()->route('post.index')->with(['msg' => 'Add new post successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::get()->pluck('name', 'id');
        return view('admin.post.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->thumbnail = $request->thumbnail;
        $post->save();
        $post->tag()->sync((array)$request->input('tag'));

        # update head tasg
        $head_tags = HeadTag::where('type', 'post')->where('type_id', $id)->first();
        if ($head_tags) {
            $head_tags->head_title = $request->header_title;
            $head_tags->head_description = $request->header_description;
        } else{
            $head_tags = new HeadTag();
            $head_tags->type = 'post';
            $head_tags->type_id = $id;
            $head_tags->head_title = $request->header_title;
            $head_tags->head_description = $request->header_description;
        }
        $head_tags->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return back()->with(['level' => 'success', 'msg' => 'The post has been deleted!']);
    }
}
