<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FinanceController extends Controller
{

    public function financePayment()
    {
        return view('finance');
    }

    public function createPaymentRequest(Request $request)
    {
        // dd($request->all());

        // Set up the Request Finance API endpoint
        $apiUrl = 'https://api.request.finance/invoices'; // Replace with the actual endpoint if different

        // Send the API request
        $response = Http::withToken(env('REQUEST_FINANCE_API_KEY'))->post($apiUrl, [
            // 'currency' => 'USD', // Define the currency for the payment
            // 'amount' => 1000, // Amount in cents (for example: $10.00)
            // 'payerEmail' => 'customer@example.com', // Payer's email
            // 'description' => 'Payment for services rendered', // Description of the payment
            // 'dueDate' => now()->addDays(7)->toIso8601String(), // Payment due date
            // 'payerWallet' => '0x...', // Crypto wallet address (if applicable)
            // 'payerWalletType' => 'ethereum' // Type of wallet

            'currency' => 'USD', // Define the currency for the payment
            'amount' => $request->amount, // Amount in cents (for example: $10.00)
            'payerEmail' => trim($request->email), // Payer's email
            'description' => trim($request->description), // Description of the payment
            'dueDate' => now()->addDays(7)->toIso8601String(), // Payment due date
            'payerWallet' => trim($request->crypto_wallet), // Crypto wallet address (if applicable)
            'payerWalletType' => trim($request->wallet_type) // Type of wallet
        ]);

        if ($response->successful()) {
            // Return the payment link to the view
            return redirect()->away($response->json('paymentLink'));
        } else {
            // Handle failure
            return redirect('/')->with('error', 'Payment request failed. Please currect the details and try again.');
        }
    }



    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        // dd($request->all());
        // Handle the webhook event, e.g., update order status, send notifications, etc.
    }


}
