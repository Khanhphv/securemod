<?php

namespace App\Http\Controllers\Admin;

use App\Model\Game;
use App\Service\GameService;
use App\Tool;
use App\HeadTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class GameController extends Controller
{
    protected GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listGames = $this->gameService->getAllGames();
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
        $this->gameService->createGame($request);
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
            $result = $this->gameService->showGame($slug);
            $game = $result[0];
            $listTools = $result[1];
            Session::put('selectedGame', $game->slug);
        } catch (Exception $e) {
            abort(500);
        }

        # get head tags
        $head_tags = HeadTag::where('type', 'game')->where('type_id', $game->id)->first();
        return view('v2.tool')->with(['tools' => $listTools, 'game' => $game, 'head_tags' => $head_tags]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = $this->gameService->getGame($id);
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
        $updatedId = $this->gameService->updateGame($id, $request);
        return redirect()->route('game.edit', $updatedId)->with(['level' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->gameService->deleteGame($id)) {
            return redirect()->route('game.index')->with(['level' => 'success', 'message' => 'Xóa thành công!']);
        }
        return redirect()->route('game.index')->with(['level' => 'danger', 'message' => 'Xóa thất bại!']);

    }
}
