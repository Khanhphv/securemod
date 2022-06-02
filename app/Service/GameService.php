<?php
namespace App\Service;

use App\Model\Game;
use App\Tool;
use App\HeadTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GameService
{
    public function getAllGames($mode = null) {
        if(!empty($mode))
        {
            return Game::orderBy('order')->whereNotNull('deleted_at')->get();
        }else{
            return Game::orderBy('order')->whereNull('deleted_at')->get();
        }
        
    }

    public function createGame($request) {
        $game = new Game();
        $game->name = $request->name;
        $game->description = $request->description;
        $game->description_eng = $request->description_eng;
        $game->notice = $request->notice;
        $game->notice_eng = $request->notice_eng;
        $game->thumb_image = $request->thumb_image;
        $game->slug = $request->slug;
        $game->order = $request->order;
        $game->save();

        # add head tags
        $head_tags = new HeadTag();
        $head_tags->type = 'game';
        $head_tags->type_id = $game->id;
        $head_tags->head_title = $request->head_title;
        $head_tags->head_description = $request->head_description;
        $head_tags->save();
    }

    public function showGame($slug) {
        $game = Game::where('slug', $slug)->get()->first();
        $listTools = Tool::where('active', true)->where('game_id', $game->id)->orderBy('order')->get();
        $game->views = $game->views + config('const.plus_views');
        $game->save();

        return [$game, $listTools];
    }

    public function getGame($id) {
        return DB::table('games as gm')
            ->select('gm.*', 'ht.head_title', 'ht.head_description')
            ->join('head_tags as ht', 'ht.type_id', '=','gm.id')
            ->where('ht.type', '=','game')
            ->where('gm.id', '=', $id)
            ->get();
    }

    public function getGameById($id) {
       return Game::findOrFail($id);
    }

    public function updateGame($id, $request) {
        $game = $this->getGameById($id);
        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->description = $request->description;
        $game->description_eng = $request->description_eng;
        $game->notice = $request->notice;
        $game->notice_eng = $request->notice_eng;
        $game->notice = $request->notice;
        $game->thumb_image = $request->thumb_image;
        $game->order = $request->order;
        $game->save();


        # update head tags for game
        $head_tags = HeadTag::where('type', 'game')->where('type_id', $id)->first();
        if ($head_tags) {
            $head_tags->head_title = $request->head_title;
            $head_tags->head_description = $request->head_description;
        } else{
            $head_tags = new HeadTag();
            $head_tags->type = 'game';
            $head_tags->type_id = $id;
            $head_tags->head_title = $request->head_title;
            $head_tags->head_description = $request->head_description;
        }
        $head_tags->save();

        return $game->id;
    }

    public function deleteGame($id) {
        $game = $this->getGameById($id);
        return Game::where('id', $game['id'])->update(['deleted_at' => now()]);
        // return $game->delete(); //original delete method, which delete forever lol
    }

    public function forceDeleteGame($id) {
        $game = $this->getGameById($id);
        //return Game::where('id', $game['id'])->update(['deleted_at' => now()]);
        return $game->delete(); //original delete method, which delete forever lol
    }

    public function restoreGame($id) {
        $game = $this->getGameById($id);
        return Game::where('id', $game['id'])->update(['deleted_at' => NULL]);
    }
}
