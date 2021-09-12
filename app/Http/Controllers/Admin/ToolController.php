<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ToolRequest;
use App\Model\Game;
use App\Tool;
use App\Key;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$listTool = Tool::join('games', 'games.id', '=', 'tools.game_id')->select('tools.*', 'games.name AS game_name')->orderBy('game_id', 'desc')->get();
        return view('admin.tools.list', compact('listTool'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::get();
        return view('admin.tools.add',compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToolRequest $request)
    {
        $this->validate($request, [
            'package' => 'required',
            'video_intro' => 'nullable|url',
            'images' => 'required|regex:/https:/'
        ], []);
        $request['updated'] = isset($request['updated']) ? 1 : 0;
        $request['active'] = isset($request['active']) ? 1 : 0;

        $packages = array();
        $lines = explode(PHP_EOL, str_replace(" ", "", $request['package']));
        foreach ($lines as $line) {
			$line = str_replace(array("\n", "\r", " "), "", $line);
            $arr = explode("=", $line);
            if (is_array($arr) && count($arr) > 1) {
                $packages[$arr[0]] = $arr[1];
            }
        }

        $resellers = array();
        $lines = explode(PHP_EOL, str_replace(" ", "", $request['reseller']));
        foreach ($lines as $line) {
            $line = str_replace(array("\n", "\r", " "), "", $line);
            $arr = explode("=", $line);
            if (is_array($arr) && count($arr) > 1) {
                $resellers[$arr[0]] = $arr[1];
            }
        }
        $cost = array();
        $listCost = explode(PHP_EOL, str_replace(" ", "", $request['cost']));
        foreach ($listCost as $lineC) {
            $lineC = str_replace(array("\n", "\r", " "), "", $lineC);
            $arr3 = explode("=", $lineC);
            if (is_array($arr3) && count($arr3) > 1) {
                $cost[$arr3[0]] = $arr3[1];
            }
        }

        $request['package'] = json_encode($packages);
        $request['reseller'] = json_encode($resellers);
        $request['cost'] = json_encode($cost);
        Tool::create($request->all());
        return redirect()->route('tool.index')->with(['level' => 'success', 'message' => 'Thêm thành công!']);
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
    public function edit(Tool $tool)
    {
        $games = Game::get();
        $packageString = "";
        if ($tool['package'] != "" && is_array(json_decode($tool['package'], true))) {
            foreach (json_decode($tool['package']) as $key => $value) {
                $packageString .= $key . "=" . $value . PHP_EOL;
            }
        }

        $resellersString = "";
        if ($tool['reseller'] != "" && is_array(json_decode($tool['reseller'], true))) {
            foreach (json_decode($tool['reseller']) as $key => $value) {
                $resellersString .= $key . "=" . $value . PHP_EOL;
            }
        }

        $costString = "";
        if ($tool['cost'] != "" && is_array(json_decode($tool['cost'], true))) {
            foreach (json_decode($tool['cost']) as $key => $value) {
                $costString .= $key . "=" . $value . PHP_EOL;
            }
        }

        $tool['package'] = $packageString;
        $tool['reseller'] = $resellersString;
        $tool['cost'] = $costString;
        return view('admin.tools.edit', compact('tool','games'));
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
        $this->validate($request, [
            'package' => 'required',
            'video_intro' => 'nullable|url',
            'images' => 'required|regex:/https:/'
        ], []);
        $data = request()->except(['_token', '_method']);

        $packages = array();
        $lines = explode(PHP_EOL, str_replace(" ", "", $data['package']));
        foreach ($lines as $line) {
			$line = str_replace(array("\n", "\r", " "), "", $line);
            $arr = explode("=", $line);
            if (is_array($arr) && count($arr) > 1) {
                $packages[$arr[0]] = $arr[1];
            }
        }

        $cost = array();
        $listCosts = explode(PHP_EOL, str_replace(" ", "", $request['cost']));
        foreach ($listCosts as $item2) {
            $item2 = str_replace(array("\n", "\r", " "), "", $item2);
            $arr2 = explode("=", $item2);
            if (is_array($arr2) && count($arr2) > 1) {
                $cost[$arr2[0]] = $arr2[1];
            }
        }


        $data['cost'] = json_encode($cost);
        $data['package'] = json_encode($packages);
        $data['updated'] = isset($data['updated']) ? 1 : 0;
        $data['active'] = isset($data['active']) ? 1 : 0;
        $data['api_get_key'] = isset($data['api_get_key']) ? $data['api_get_key'] : null;
        $data['video_intro'] = isset($data['video_intro']) ? $data['video_intro'] : null;
        Tool::where('id', $id)->update($data);
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
       Tool::where('id', $id)->delete();
	   Key::where('tool_id', $id)->delete();
	   return back()->with(['level' => 'success', 'message' => 'Đã xóa!']);
    }
}
