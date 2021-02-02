<?php

namespace App\Http\Controllers\Admin;

use App\Model\Game;
use App\Tool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listGames = Game::orderBy('order')->get();
        return view('admin.game.list', compact('listGames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.add');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:500',
            'slug' => 'required|max:500',
            'description' => 'required|max:500',
            'description_eng' => 'required|max:500',
            'thumb_image' => 'required',
            'order' => 'required'
        ]);
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
        return redirect()->route('game.index')->with(['level' => 'success', 'message' => 'Thêm thành công!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $game = Game::where('slug', $slug)->get()->first();
            $listTools = Tool::where('active', true)->where('game_id', $game->id)->orderBy('order')->get();
            $game->views = $game->views + config('const.plus_views');
            $game->save();
            Session::put('selectedGame', $game->slug);
        } catch (Exception $e) {
            abort(500);
        }
        return view('v2.tool')->with(['tools' => $listTools, 'game' => $game]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.game.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:500',
            'slug' => 'required|max:500',
            'description' => 'required|max:500',
            'description_eng' => 'required|max:500',
            'thumb_image' => 'required',
            'order' => 'required',
        ]);
        $game = Game::findOrFail($id);
        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->description_eng = $request->description_eng;
        $game->notice = $request->notice;
        $game->notice_eng = $request->notice_eng;
        $game->notice = $request->notice;
        $game->thumb_image = $request->thumb_image;
        $game->order = $request->order;
        $game->save();
        return redirect()->route('game.edit', $game->id)->with(['level' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        if ($game->delete()) {
            return redirect()->route('game.index')->with(['level' => 'success', 'message' => 'Xóa thành công!']);
        }
        return redirect()->route('game.index')->with(['level' => 'danger', 'message' => 'Xóa thất bại!']);

    }
}
