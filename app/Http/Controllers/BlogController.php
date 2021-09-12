<?php
namespace App\Http\Controllers;

use App\Service\BlogService;

class BlogController extends Controller
{
    protected BlogService $blogService;

    /**
     * BlogController constructor.
     * @param BlogService $blogService
     */
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index() {
		$blogs = $this->blogService->getAllBlog();
		return view('new.blog', compact('blogs'));
	}

	public function blogOfGame($game_id) {
		$blogs = $this->blogService->getBlogGame($game_id);
		return view('new.blog', compact('blogs'));
	}


	public function show($id = 6) {
        $show = $this->blogService->show($id);
        $content = $show[0];
        $relevancies = $show[1];
		return view('new.blog-content2', compact('content', 'relevancies'));
	}

    public  function blog($id = 21){
        $content = $this->blogService->get($id);
        return view('new.blog-content2', compact('content'));
    }


	public function showBlog($slug) {
        $data = $this->blogService->showBlog($slug);
        $content = $data[0];
        $relevancies = $data[1];
		shuffle($relevancies);
		return view('new.blog-content-test', compact('content', 'relevancies'));
	}

}
