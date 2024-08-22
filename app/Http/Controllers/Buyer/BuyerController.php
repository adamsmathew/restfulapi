<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\Controller; // Correct import
use Illuminate\Http\Request;

class BuyerController extends Controller // Extend the correct class
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Buyer $buyer)
    // {
    //     return $this->showOne($buyer);
    // }
}
