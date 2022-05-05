<?php

namespace App\Http\Controllers\Admin;

use App\Key;
use App\Model\History;
use App\Hwid;
use App\HwidLogs;
use App\Service\KeyService;
use App\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class KeyController extends Controller
{

    protected KeyService $keyService;


    public function __construct(KeyService $keyService)
    {
        $this->keyService = $keyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listKeys = $this->keyService->getAllKey();
        return view('admin.keys.list', compact('listKeys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $listTool = $this->keyService->getTool();
	   return view('admin.keys.add', compact('listTool'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keys' => 'required',
            'tool_id' => 'required',
            'package' => 'required'
        ], []);

        $checkKey = $this->keyService->saveKey($request);
        if (count($checkKey) == 0) {
            return back()->with(['level' => 'success', 'message' => 'Thêm thành công, có 0 key bị trùng!']);
        } else
            return back()->with(['level' => 'warning', 'message' => 'Thêm thành công ' . (count($lines) - count($checkKey)) . ' key, có ' . count($checkKey) . ' key bị trùng!'])->with('listKeyExists', $checkKey);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Key $key
     * @return \Illuminate\Http\Response
     */
    public function edit($idKey)
    {
        $edited = $this->keyService->editKey($idKey);
        list($key, $listTool, $history, $hwidLogs, $debugs) = $edited;
        if ($key->hwid != null) {
            $hwid = substr($key->hwid, 0, strlen($key->hwid) - 3);
            $historyHwids = Hwid::where('hwid', 'LIKE', '%' . $hwid . '%')->get();
            if ($historyHwids != null) {
                return view('admin.keys.edit', compact('key', 'listTool', 'history', 'hwidLogs', 'historyHwids', 'debugs'));
            }
        }
        return view('admin.keys.edit', compact('key', 'listTool', 'history', 'hwidLogs', 'debugs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $this->keyService->updateKey($id, $data);
        return back()->with(['level' => 'success', 'message' => 'Cập nhật thành công!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $res = DB::table('keys')->where('id',$id)->delete();
        if ($res) {
            return back()->with(['level' => 'danger', 'message' => 'Đã xoá key mang ID: '.$id]);
        } else {
            return back()->with(['level' => 'danger', 'message' => 'Đã có lỗi xảy ra: '.$res]);
        }
    }

    public function ajax(Request $request)
    {

    }

    public function searchVc(Request $request)
    {
        $listKeys = $this->keyService->searchVc($request);
        return view('admin.keys.result', ['listKeys' => $listKeys->appends($request->except('page'))]);
    }
}
