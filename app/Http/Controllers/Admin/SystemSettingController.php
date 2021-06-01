<?php

namespace App\Http\Controllers\Admin;

use App\Service\SystemService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MasterSiteSetting;
use Illuminate\Support\Facades\View;
use File;
use Illuminate\Support\Str;


class SystemSettingController extends Controller
{
    protected SystemService $systemService;

    /**
     * SystemSettingController constructor.
     * @param SystemService $systemService
     */
    public function __construct(SystemService $systemService)
    {
        $this->systemService = $systemService;
    }

    // get site settings info
    public function index()
    {
        $settings = $this->systemService->getMasterSetting(1);
        return view('admin.setting', compact('settings'));
    }

    /**
     *  change logo function
     */
    public function ChangeLogoSystem(Request $request)
    {
        # validate request
        $request->validate([
            'for_support' => ['required', 'email'],
            'verified_seller_url' =>['required', 'url'],
            'about_us' => ['required']
        ]);
        $this->systemService->changeLogo($this, $request);

        return redirect()->route('setting_system')->with(['msg' => 'Update site settings successful']);
    }

    /**
     *  store file
     */
    public function store($request, $settings, $logo)
    {
        $oldFile = $settings[$logo];
        File::Delete($oldFile);
        $file = $request[$logo];
        $uploadFolder = ($logo == 'favicon' ? '/' : '/images/logo/');
        $filename = Str::random() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path() . $uploadFolder, $filename);
        return $filename;
    }
}
