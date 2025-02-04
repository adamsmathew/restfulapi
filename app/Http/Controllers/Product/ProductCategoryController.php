<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $categories = $product->categories;

        return$this->showAll($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product, Category $category)
    {
        $product->categories()->attach([$category->id]);

        return $this->showAll($product->categories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product , Category $category)
    {
        if(!$product->categories()->find($category->id)){
            return $this->errorResponse('the specified category is not a category of this product',404);
        }

        $product->categories()->detach($category->id);

        return $this->showAll($product->categories);
        
    }
}
