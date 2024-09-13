<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a form for creating a new resource.
     */
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
            'type' => 'required|in:deposit,transfer,withdraw'
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

        switch ($transaction->type) {
            case 'transfer':
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
                break;

            case 'deposit':
                $senderBalance->value += $transaction->amount;
                $senderBalance->save();
                break;

            case 'withdraw':
                $senderBalance->value -= $transaction->amount;
                $senderBalance->save();
                break;

            default:
                return Redirect::back()->with('error', 'Invalid transaction type');
                break;
        }

        return Redirect('/dashboard');
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
