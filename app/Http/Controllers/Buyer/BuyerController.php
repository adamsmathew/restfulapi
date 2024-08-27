<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;


class BuyerController extends ApiController
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        
        $buyers = Buyer::has('transactions')->get();

        return $this->showall($buyers);
    }

    public function show(Buyer $buyer)
    {

        // $buyer = Buyer::has('transactions')->findOrFail($id);
        
        return $this->showOne($buyer);
    }
}
