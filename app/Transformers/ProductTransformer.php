<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'identifier' =>(int)$product->id,
            'title' =>(string)$product->name,
            'detail' =>(string)$product->email,
            'stock' =>(int)$product->quantity,
            'situation' =>(string)$product->status,
            'picture' =>url("img/{$product->image}"),
            'seller' =>(int)$product->seller_id,
            'creationDate' =>$product->created_at,
            'lastChange' =>$product->updated_at,
            'deletedDate' =>isset($seller->deleted_at) ? (string) $user->deleted_at : null,

        ];
    }
    public function orginalAttribute($index)
    {
        $attributes = [
            'identifier' =>'id',
            'title' =>'name',
            'details' =>'description',
            'stock' =>'quantity',
            'situation' =>'status',
            'picture' =>'image',
            'seller' =>'seller_id',
            'creationDate' =>'created_at',
            'lastChange' =>'updated_at',
            'deletedDate' =>'deleted_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
