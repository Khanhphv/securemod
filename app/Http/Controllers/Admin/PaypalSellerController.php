<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaypalSeller;

class PaypalSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller = new PaypalSeller();
        $seller->seller_name = $request->seller_name;
        $seller->discord = $request->discord;
        $seller->payment_options = $request->payment_options;
        $seller->more_infomation = $request->more_infomation;
        $seller->save();
        return redirect()->route('payment_settings')->with(['msg' => 'Add new seller successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $seller = PaypalSeller::findOrFail($request->seller_id);
        $seller->seller_name = $request->seller_name;
        $seller->discord = $request->discord;
        $seller->payment_options = $request->payment_options;
        $seller->more_infomation = $request->more_infomation;
        $seller->save();
        return redirect()->route('payment_settings')->with(['msg' => 'Update seller successful']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaypalSeller::where('id', $id)->delete();
        return back()->with(['level' => 'success', 'msg' => 'The seller has been deleted!']);
    }
}
