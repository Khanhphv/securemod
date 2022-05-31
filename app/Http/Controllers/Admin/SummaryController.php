<?php


namespace App\Http\Controllers\Admin;


use App\Service\SummaryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Summary\SummaryExcelController;

class SummaryController
{
    /**
     * Lấy thông tin tiền
     *
     */
    public function getMoneySummary(Request $request) {
        $getType = $request->get('type');
        $startDate = $request->get('start');
        $endDate = $request->get('end');
        $summaryService = new SummaryService();
        $summaryInfo = $summaryService->getMoney($getType, $startDate, $endDate);
        return view(
            'admin.summary.summary',
            [
                'summary' => $summaryInfo['money'],
                'tools' => $summaryInfo['tool']
            ]
        );
    }
    /**
     * Lấy thông kế về top 5 Key trong
     *
     */
    public function getKeySummary(Request $request) {
        $summaryService = new SummaryService();
        $start = $request->get('start');
        $type = $request->get('type');
//        $endDate = $request->get('$endDate');
        $keyInfo = $summaryService->getTopKey($type, $start);
        return response()->json(
           $keyInfo
        );
    }

    public function summaryWithEachKey( Request $request) {
        $summaryService = new SummaryService();
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $type =  $request->get('type');
        $key = $request->get('key');
        $key = explode(',', $key);
        $condition = $request->get('condition');
        $keyInfo = $summaryService->getKey($type, $key, $startDate, $endDate, $condition);
        return response()->json(
            $keyInfo
        );
    }

    /**
     * Lấy thông kế key được bán ra
     *
     */
    public function getSoldKey(Request $request)
    {
        $summaryService = new SummaryService();
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $type =  $request->get('type');
        $response = $summaryService->getSoldKey($type, $startDate, $endDate);
        return response()->json($response);
    }

//    public function exportCSV(Request $request)
//    {
//        $type = $request->get('type');
//        $date = $request->get('date');
//        $data = new SummaryExcelController($type, $date);
//        $file_name = 'summary' . Carbon::now()->format('Ymd');
//        $response = $data->getPathFile($file_name);
//        if($response["status"]){
//            return response()->download($response["filePath"]);
//        } else {
//            return "No data";
//        }
//    }

    public function statisticPackageKeyByAll(Request $request) {
        $key = $request->get('key');
        $date = $request->get('date');
        $summaryService = new SummaryService();
        $data = $summaryService->statisticPackageKeyByAll($key, $date, '');
        return response()->json($data);
    }

}
