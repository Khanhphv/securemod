<?php

namespace App\Http\Controllers\Admin;

use App\Option;
use App\Paypal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset(request()->lang) === false) {
            request()->lang = 'en';
        }
        $siteSettings = Option::select('option', 'value')->where('locate', request()->lang)->get()->keyBy('option')->pluck('value', 'option');
        $listPayment = Paypal::from('paypal as p')
            ->select('p.id','p.name', 'p.client_id', 'p.client_secret')->get();
        return view('admin.options.index', compact('siteSettings','listPayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Option::where('option', $key)->where('locate', '=', $request->locate)->update(['value' => $value, 'locate' => $request->locate]);
        }
        return redirect()->route('setting.index')->with(['level' => 'success', 'message' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }
}
