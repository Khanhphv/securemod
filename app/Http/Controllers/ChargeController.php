<?php

namespace App\Http\Controllers;

use App\Model\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Service\ChargeService;
use Log;

class ChargeController extends Controller
{
    public function chargeViaLexHolding(Request $rq)
    {
        $urlPayment = "https://paydash.co.uk/api/merchant/create";
        $chargeService = new ChargeService();
        $response = $chargeService->chargeViaLexHolding($rq, $urlPayment);
        return ($response);
    }

    public function insertTransaction(Request $rq)
    {
        Log::info("[insertTransaction] begin controller ->insert transaction " . $rq);
        $chargeService = new ChargeService();
        $response = $chargeService->insertTransaction($rq->all());
        Log::info("[insertTransaction] end controller " . json_encode($response));
        return $response ."";
    }
}
