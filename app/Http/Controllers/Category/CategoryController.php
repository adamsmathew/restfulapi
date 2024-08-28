<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return $this->showAll($categories);
    }

   

    public function store(Request $request)
    {
        $rules = [
            'name' =>'required',
            'description' => 'required',
        ];

        $this->validate($request, $rules);

        $newCategory = Category::create($request->all());

        return $this->showOne($newCategory,201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->only(['name', 'description']);
    
        // If no data was sent to update, return an error response
        if (empty($data)) {
            return $this->errorResponse('You need to specify any different value to update', 422);
        }
    
        $category->fill($data);
    
        // Check if any attributes have actually changed
        if ($category->isClean()) {
            return $this->errorResponse('You need to specify any different value to update', 422);
        }
    
        $category->save();
    
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->showOne($category);
    }
}
