<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;

class PaymentsController extends Controller
{
    public function checkout(Request $request){
        $gateway = new Braintree\Gateway([
            'environment' => "sandbox",
            'merchantId' => "rbhzcjjb2rtjsx4j",
            'publicKey' => "8hsqrm2vqx9twkpw",
            'privateKey' => "1971b9924ee94d6d0320bc61d1ccb6be"
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

        if ($result->success) {
            $transaction = $result->transaction;
            // return back()->with("success_message", "Transation successful. The ID is:" .$transaction->id);
            $item = "Transazione avvenuta con successo! Ordine Creato!";
            return view("frontSuccess", compact("item"));
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors("An error occurred with the message:" .$result->message);
        
        }}
}
