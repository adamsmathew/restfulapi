<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        // Assuming you want to get transactions related to buyers
        $transactions = Transaction::with('buyer')->get();

        return response()->json(['data' => $transactions], 200);
    }

    public function show($id)
    {
        // Assuming you want to get transactions related to buyers
        $transaction = Transaction::with('buyer')->findOrFail($id);
        
        return response()->json(['data' => $transaction], 200);
    }

}
