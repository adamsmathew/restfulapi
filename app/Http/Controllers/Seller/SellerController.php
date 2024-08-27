<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
// use App\Models\User;


class SellerController extends ApiController
{
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return $this->showall($sellers); 
    }


    public function show(Seller $seller)
    {
        // $seller = Seller::has('products')->findOrFail($id);

        return $this->showOne($seller);    }
}
