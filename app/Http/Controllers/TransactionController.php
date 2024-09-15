<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class TransactionController extends Controller
{
    /**
     * Display a form for creating a new resource.
     */
    public function create(string $type)
    {
        $users = User::all();
        return view('transaction/create', compact('users', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required_if:type,transfer|exists:users,id',
            'type' => 'required|in:deposit,transfer,withdraw'
        ]);

        $sender = User::findOrFail($request->input('sender_id'));
        $amount = $request->input('amount');

        // Fetch the sender's balance (assuming a relation like hasOne or belongsTo)
        $senderBalance = $sender->balance;  // Assuming User has a hasOne relationship with Balance

        if (!$senderBalance) {
            return Redirect::back()->withErrors('Sender has no balance record.');
        }

        // Initialize a new transaction
        $transaction = new Transaction();
        $transaction->type = $request->input('type');
        $transaction->amount = $amount;
        $transaction->sender()->associate($sender);
        $transaction->receiver_id = $request->input('receiver_id');
        $transaction->date = \Carbon\Carbon::today();

        try {
            switch ($transaction->type) {
                case 'transfer':
                    $receiver = User::findOrFail($transaction->receiver_id);
                    $receiverBalance = $receiver->balance;

                    if (!$receiverBalance) {
                        return Redirect::back()->withErrors('Receiver has no balance record.');
                    }

                    // Check if sender has sufficient balance
                    if ($senderBalance->value < $amount) {
                        return Redirect::back()->withErrors('Insufficient balance for transfer.');
                    }

                    // Update balances
                    $senderBalance->value -= $amount;
                    $receiverBalance->value += $amount;

                    // Save both balances
                    $senderBalance->save();
                    $receiverBalance->save();

                    // Save the transaction
                    $transaction->save();
                    break;

                case 'deposit':
                    $senderBalance->value += $amount;
                    $senderBalance->save();
                    $transaction->save();
                    break;

                case 'withdraw':
                    // Check if sender has sufficient balance
                    if ($senderBalance->value < $amount) {
                        return Redirect::back()->withErrors('Insufficient balance for withdrawal.');
                    }

                    // Deduct the amount from the sender's balance
                    $senderBalance->value -= $amount;
                    $senderBalance->save();
                    $transaction->save();
                    break;

                default:
                    return Redirect::back()->withErrors('Invalid transaction type.');
            }
        } catch (\Exception $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }

        // Redirect to dashboard with success message
        return Redirect::to('/dashboard')->with('success', 'Transaction successful!');
    }



    public function transactionHistory(Request $request)
    {
        $user = $request->user();
        $date = $request->input('date');

        // Fetch the transaction history for the given date
        $transactionHistory = Transaction::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->whereDate('date', $date)
            ->with('sender', 'receiver')
            ->get();

        return response()->json(['transactions' => $transactionHistory]);
    }
}
