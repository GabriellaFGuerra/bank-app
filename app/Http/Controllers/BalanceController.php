<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{

    public function index()
    {
        $balance = Auth::user()->balances;
        if (!$balance) {
            return response()->json(['message' => 'Balance not found'], 404);
        } else {
            return response()->json($balance);
        }
    }

    public function show(Balance $balance)
    {
        return response()->json($balance);
    }
}
