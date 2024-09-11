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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'numeric',
            'sender_id' => 'in:users,id|different:receiver_id',
            'receiver_id' => 'in:users,id',
        ]);

        $sender = User::where('id', $request->input('sender_id'))->first();
        $receiver = User::where('id', $request->input('receiver_id'))->first();

        if ($sender->balance->latest() < $request->input('amount')) {
            return response()->json(['message' => 'Transaction failed, insufficient balance'], 400);
        } else {
            $sender->balance->update($sender->balance->latest() - $request->input('amount'));
            $receiver->balance->update($receiver->balance->latest() + $request->input('amount'));
            $transaction = Transaction::create($request->all());
            return response()->json($transaction);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return response()->json($transaction);
    }
}
