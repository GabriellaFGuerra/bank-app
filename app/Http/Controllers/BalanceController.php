<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Carbon;

class BalanceController extends Controller
{

    public function index()
    {
        $balance = Auth::user()->balance;
        if (!$balance) {
            return response()->json(['message' => 'Balance not found'], 404);
        } else {
            return response()->json($balance);
        }
    }
    public function dailyHistory(Request $request)
    {
        $user = $request->user();
        $date = $request->input('date', Carbon::today());

        // Fetch all transactions where the user is either the sender or receiver
        $transactions = Transaction::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->whereDate('created_at', $date)
            ->get();

        // Group transactions by type (deposit, transfer)
        $groupedTransactions = $transactions->groupBy('type');

        // Get current balance (optional: you can fetch it based on actual balance)
        $currentBalance = $user->balance->value;

        return response()->json([
            'date' => $date,
            'balance' => $currentBalance,
            'transactions' => $groupedTransactions,
        ]);
    }
}
