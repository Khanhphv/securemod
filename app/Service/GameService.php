<?php
namespace App\Service;

use App\Model\Game;
use App\Tool;

class GameService
{
    public function getAllGames() {
        return Game::orderBy('order')->get();
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
    }

    public function showGame($slug) {
        $game = Game::where('slug', $slug)->get()->first();
        $listTools = Tool::where('active', true)->where('game_id', $game->id)->orderBy('order')->get();
        $game->views = $game->views + config('const.plus_views');
        $game->save();

        return [$game, $listTools];
    }

    public function getGame($id) {
        return Game::findOrFail($id);
    }

    public function updateGame($id, $request) {
        $game = $this->getGame($id);
        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->description_eng = $request->description_eng;
        $game->notice = $request->notice;
        $game->notice_eng = $request->notice_eng;
        $game->notice = $request->notice;
        $game->thumb_image = $request->thumb_image;
        $game->order = $request->order;
        $game->save();

        return $game->id;
    }

    public function deleteGame($id) {
        $game = $this->getGame($id);

        return $game->delete();
    }
}
