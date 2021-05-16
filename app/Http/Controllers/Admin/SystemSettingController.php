<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input as Input;
use File;


class SystemSettingController extends Controller
{
    public function index()
    {
        return view('admin.setting');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'logo_mini' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    }

    /**
     *  change logo function
     */
    public function ChangeLogoSystem(Request $request)
    {
//        dd($request->all());

        // change logo mini
        if (Input::hasFile('logo_mini')) {
            $this->store('logo_mini');
        }

        // change logo
        if (Input::hasFile('logo')) {
            $this->store('logo');
        }

        return redirect()->route('setting_system')->with(['msg' => 'Update logo successfull']);
    }

    /**
     *  store file
     */
    public function store($file_name)
    {
        if (file_exists("/images/logo/" . $file_name . ".png")) unlink("/images/logo/" . $file_name . ".png");
        $file = Input::file($file_name);
        $uploadFolder = '/images/logo/';
        $filename = $file_name . '.png';
        $file->move(public_path() . $uploadFolder, $filename);
    }
}
