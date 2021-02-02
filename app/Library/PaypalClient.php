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

        $clientId = getenv("CLIENT_ID") ?: Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_id;
        $clientSecret = getenv("CLIENT_SECRET") ?: Option::where('option', 'paypal_id')->join('paypal', 'paypal.id', 'options.value')->get()->first()->client_secret;
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}
