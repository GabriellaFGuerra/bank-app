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

    public function balanceHistory(Request $request)
    {
        $user = $request->user();
        $date = $request->input('date');

        // Fetch the balance history for the given date
        $balanceHistory = Balance::where('user_id', $user->id)
            ->whereDate('date', $date)
            ->first();

        if (!$balanceHistory) {
            return response()->json(['balance' => null], 200);
        }

        return response()->json(['balance' => $balanceHistory->value], 200);
    }
}
