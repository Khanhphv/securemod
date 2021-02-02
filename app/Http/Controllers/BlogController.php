<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index() {
		$blogs = Blog::join('games', 'games.id', '=', 'blogs.game_id')->select('blogs.*', 'games.id AS game_id', 'games.name AS game_name')->paginate(50);
		return view('new.blog', compact('blogs'));
	}

	public function blogOfGame($game_id) {
		$blogs = Blog::join('games', 'games.id', '=', 'blogs.game_id')->where('blogs.game_id', $game_id)->select('blogs.*', 'games.id AS game_id', 'games.name AS game_name')->paginate(50);
		return view('new.blog', compact('blogs'));
	}


	public function show($id = 6) {
        $content = Blog::where('id', $id)->first();
        $relevancies = Blog::where('id', '!=', $id)->limit(2)->get();
		return view('new.blog-content2', compact('content', 'relevancies'));
	}

        public  function blog($id = 21){
               $content = Blog::where('id', $id)->first();
               return view('new.blog-content2', compact('content'));
        }


	public function showBlog($slug) {
        $content = Blog::join('games', 'games.id', '=', 'blogs.game_id')
            ->select([
                'title',
                'content',
                'name',
                'description',
                'keyword',
                'slug'
            ])
            ->where('games.slug', $slug)
            ->get()->first();
        if ($content === null) {
            return abort(500);
        };
		$relevancies =  Blog::join('games', 'games.id', '=', 'blogs.game_id')->get()->toArray();
		shuffle($relevancies);
		return view('new.blog-content-test', compact('content', 'relevancies'));
	}

}
