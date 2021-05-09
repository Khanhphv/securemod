<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use App\Option;
ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PaypalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use ProductionEnvironment.
     */
    public static function environment()
    {
//Phuong Duy
//        $clientId = getenv("CLIENT_ID") ?: "Aev-hYxv9I5x7XPPHskHNNjJ4iB_1G8uklGFr4DWIfDgpO0FcE9e9_2cs4hCkMBtUNhqasAfQhBZ09if";
//        $clientSecret = getenv("CLIENT_SECRET") ?: "EG4wmDOnV72EWu1VRbh4yEtzNpK778DjtLYsR1Tr9ZgqdYuxvJZWv0zsMo_JL4dWSFHO7zpdP3IyPRq3";

// Thu Xuan
//        $clientId = getenv("CLIENT_ID") ?: "AZD3imApo6RAnkSsuIHn6YRBQdCPFaVSsUYQ3O6J-LKSEEvvgKYYMCv2dUY_RrZMW56uZ7o8DuDwMftf";
//        $clientSecret = getenv("CLIENT_SECRET") ?: "EBqrX5N9n1fNppd1D1wVCkFJ0PyvV8FpD6xoev3xForef2WSrsKGz_EngfpLsrh8SmH-WqXVhZYLJfhc";

        $clientId = getenv("CLIENT_ID") ?: Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_id;
        $clientSecret = getenv("CLIENT_SECRET") ?: Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_secret;
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}
