<?php

namespace App\Http\Controllers\Admin;

use App\Option;
use App\Paypal;
use App\Service\OptionService;
use App\Service\PaypalService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    protected OptionService $optionService;
    protected PaypalService $paypalService;
    /**
     * OptionController constructor.
     * @param OptionService $optionService
     */
    public function __construct(OptionService $optionService, PaypalService $paypalService)
    {
        $this->optionService = $optionService;
        $this->paypalService = $paypalService;
    }

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
        $siteSettings = $this->optionService->getOption(request()->lang);
        $listPayment = $this->paypalService->getListPayment();
        return view('admin.options.index', compact('siteSettings','listPayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $this->optionService->updateOption($request);
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
