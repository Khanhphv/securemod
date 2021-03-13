<?php


namespace App\Http\Controllers;


use App\Model\History;
use App\User;
use Illuminate\Http\Request;

class CheckoutController
{

    public function index(Request $request)
    {
        $amount = $request->get('amount');
        if(isset($amount) == false) {
            abort(500);
        }
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        $amount *= 100;
        $amount = (int) $amount;

        $customer = \Stripe\Customer::create([
            'name' => \Auth::user()->name,
            'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
            ],
        ]);
        $payment_intent = \Stripe\PaymentIntent::create([
            'customer' => $customer['id'],
            'description' => 'Charge',
            'amount' => $amount,
            'currency' => 'USD',
            'description' => 'Payment',
            'payment_method_types' => ['card'],
        ]);

        $intent = $payment_intent->client_secret;
        return view('new.stripe-payment',compact('intent'));

    }

    public function checkoutWithStripe(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(
                getenv('STRIPE_SECRET_KEY')
            );
            $id = $request->get("id");
            if (!isset($id)) {
                abort(500);
            }
            $paymentInfo = $stripe->paymentIntents->retrieve(
                $id,
                []
            );

            if ($paymentInfo['status'] == "succeeded") {
                $processedTransaction = History::where('nl_token', $paymentInfo['id'])->first();
                if ($processedTransaction) {
                    abort(500);
                }
                $user = \Auth::user();
                $nl_token = $paymentInfo['id'];
                $transactionID = $nl_token;
                $amount = (float)($paymentInfo['amount'] /100);
                $action = "CHARGE_VIA_STRIPE";
                $revenue = 0;
                $content = "Charging via Stripe, transaction ID is " . $transactionID . ". Email: " . $user->email;
                $history = new History();
                $history->nl_token = $nl_token;
                $history->user_id = $user->id;
                $history->amount = $amount;
                $history->action = $action;
                $history->revenue = $revenue;
                $history->content = $content;
                $history->need_to_verify = false;
                $history->save();


                $old_money_user = $user->credit;
                $user->credit += $amount;
                $user->total_paypal_credit += $amount;
                $user->save();

                $acceptedHistory = new History();
                $acceptedHistory->need_to_verify = false;
                $acceptedHistory->action = 'ACCEPTED_PAYMENT';
                $acceptedHistory->user_id = $user->id;
                $acceptedHistory->amount = 0;
                $acceptedHistory->content = "Auto Accept, transaction ID is " . $transactionID . ". Your balance from " .
                    number_format($old_money_user, 2) . " to " . number_format($user->credit, 2);
                $acceptedHistory->nl_token = null;
                $acceptedHistory->save();

            }
        } catch (\Exception $e) {
            \Log::error("[STRIPE]" . $e->getMessage());
            abort(500);
        }
        return redirect('/balance')->with('isShowPopup', false);
    }
}
