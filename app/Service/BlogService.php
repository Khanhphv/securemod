<?php
namespace App\Service;

use App\Blog;

class BlogService
{
    public CommonService $commonService;

    /**
     * BlogService constructor.
     * @param CommonService $commonService
     */
    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function getAllBlog() {
        return Blog::join('games', 'games.id', '=', 'blogs.game_id')->select('blogs.*', 'games.id AS game_id', 'games.name AS game_name')->paginate(50);
    }

    public function getBlogGame($gameId) {
        return Blog::join('games', 'games.id', '=', 'blogs.game_id')->where('blogs.game_id', $gameId)->select('blogs.*', 'games.id AS game_id', 'games.name AS game_name')->paginate(50);
    }

    public function show($id): array {
        $content = Blog::where('id', $id)->first();
        $relevancies = Blog::where('id', '!=', $id)->limit(2)->get();

        return [$content, $relevancies];
    }

    public function get($id) {
        return Blog::where('id', $id)->first();
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

        return [$content, $relevancies];
    }
}
