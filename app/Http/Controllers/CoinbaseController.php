<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Transaction;

class CoinbaseController extends Controller
{
    protected $apiKey;
    protected $apiVersion;
    protected $baseUrl;

    public function __construct()
    {
        $this->middleware('auth');
        $this->apiKey = env('COINBASE_API_KEY');
        $this->apiVersion = '2018-03-22';
        $this->baseUrl = 'https://api.commerce.coinbase.com';
    }

    public function showDepositForm()
    {
        return view('coinbase.deposit');
    }

    public function createCharge(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        $response = Http::withHeaders([
            'X-CC-Api-Key' => $this->apiKey,
            'X-CC-Version' => $this->apiVersion,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl . '/charges', [
            'name' => 'Deposit to Weed Store',
            'description' => 'Add funds to your account balance',
            'pricing_type' => 'fixed_price',
            'local_price' => [
                'amount' => $amount,
                'currency' => 'USD'
            ],
            'metadata' => [
                'user_id' => $user->id,
                'transaction_type' => 'deposit'
            ],
            'redirect_url' => route('coinbase.success'),
            'cancel_url' => route('coinbase.cancel'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Save transaction record
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => 'deposit',
                'status' => 'pending',
                'reference' => $data['data']['code'],
            ]);

            return redirect($data['data']['hosted_url']);
        }

        return back()->with('error', 'Failed to create payment. Please try again.');
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        $signature = $request->header('X-CC-Webhook-Signature');
        $sharedSecret = env('COINBASE_WEBHOOK_SECRET');

        // Verify webhook signature
        if (!$this->verifySignature($payload, $signature, $sharedSecret)) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $event = $payload['event'];

        if ($event['type'] === 'charge:confirmed') {
            $chargeData = $event['data'];
            $metadata = $chargeData['metadata'];
            $userId = $metadata['user_id'];
            $transactionType = $metadata['transaction_type'];
            $amount = $chargeData['pricing']['local']['amount'];
            $reference = $chargeData['code'];

            // Find transaction
            $transaction = Transaction::where('reference', $reference)->first();

            if ($transaction && $transaction->status === 'pending') {
                // Update transaction status
                $transaction->update(['status' => 'completed']);

                // Update user balance
                $user = User::find($userId);
                if ($user) {
                    $user->balance += $amount;
                    $user->save();
                }
            }
        }

        return response()->json(['success' => true]);
    }

    protected function verifySignature($payload, $signature, $sharedSecret)
    {
        // Implementation of signature verification
        $computedSignature = hash_hmac('sha256', json_encode($payload), $sharedSecret);
        return hash_equals($computedSignature, $signature);
    }

    public function success()
    {
        return view('coinbase.success');
    }

    public function cancel()
    {
        return view('coinbase.cancel');
    }
}
