<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use App\Model\Game;
use App\Blog;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$blogs = Blog::join('games', 'games.id', '=', 'blogs.game_id')->join('users', 'users.id', '=', 'blogs.user_id')->select('blogs.*', 'users.name AS user_name', 'games.name AS game_name')->orderBy('id', 'desc')->get();
        return view('admin.blogs.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::get();
        return view('admin.blogs.add',compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
		$data = request()->except(['_token', '_method']);
		$user = Auth::user();
		$data['user_id'] = $user->id;
		
        Blog::create($data);
        return redirect()->route('blog.index')->with(['level' => 'success', 'message' => 'Thêm thành công!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $games = Game::get();
        return view('admin.blogs.edit', compact('blog','games'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $data = request()->except(['_token', '_method']);
		$user = Auth::user();
		$data['user_id'] = $user->id;
        Blog::where('id', $id)->update($data);
        return back()->with(['level' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Blog::where('id', $id)->delete();
	   return back()->with(['level' => 'success', 'message' => 'Đã xóa!']);
    }
}
