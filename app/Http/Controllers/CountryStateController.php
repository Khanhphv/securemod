<?php


namespace App\Http\Controllers;


use App\Service\CountryStateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryStateController extends Controller
{
    public function getCountry(): JsonResponse
    {
        $contryStateService = new CountryStateService();
        $allCounrtry = $contryStateService->getAllCountry();
        return response()->json([
           "data" => $allCounrtry
        ]);
    }

    public function getState(Request $request): JsonResponse
    {
        $name = $request->get('country');
        $contryStateService = new CountryStateService();
        $allState = $contryStateService->getStateByCountry($name);
        return response()->json([
            "data" => $allState
        ]);
    }
}
