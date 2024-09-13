<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('sender_id', Auth::id())->get();
        return response()->json($transactions);
    }

    public function create()
    {
        $users = User::all();
        return view('transaction/create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required_if:type,transfer|exists:users,id',
            'type' => 'required|in:deposit,transfer'
        ]);

        $transaction = new Transaction();
        $transaction->type = $request->input('type');
        $transaction->amount = $request->input('amount');
        $transaction->sender_id = $request->input('sender_id');
        $transaction->receiver_id = $request->input('receiver_id');
        $transaction->date = \Carbon\Carbon::today();
        $transaction->save();

        $sender = User::where('id', $transaction->sender_id)->firstOrFail();
        $senderBalance = $sender->balance;

        if ($transaction->type == 'transfer') {
            // Ensure sender has enough balance
            if ($senderBalance->value < $transaction->amount) {
                return response()->json(['error' => 'Insufficient balance'], 400);
            }

            // Deduct from sender's balance
            $senderBalance->value -= $transaction->amount;
            $senderBalance->save();

            // Add to receiver's balance
            $receiver = User::where('id', $transaction->receiver_id)->firstOrFail();
            $receiverBalance = $receiver->balance;
            $receiverBalance->value += $transaction->amount;
            $receiverBalance->save();
        } else {
            $senderBalance->value += $transaction->amount;
            $senderBalance->save();
        }

        return response()->json(['transaction' => $transaction, 'balance' => $senderBalance]);
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


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }
}
