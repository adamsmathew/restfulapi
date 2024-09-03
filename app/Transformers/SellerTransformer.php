<?php

namespace App\Transformers;

use App\Models\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'identifier' =>(int)$seller->id,
            'name' =>(string)$seller->name,
            'email' =>(string)$seller->email,
            'isVerified' =>(int)$seller->verified,
            'isAdmin' =>($user->seller ==='true'),
            'creationDate' =>$seller->created_at,
            'lastChange' =>$seller->updated_at,
            'deletedDate' =>isset($seller->deleted_at) ? (string) $user->deleted_at : null,

        ];
    }
    public function orginalAttribute($index)
    {
        $attributes = [
            'identifier' =>'id',
            'name' =>'name',
            'email' =>'email',
            'isVerified' =>'verified',
            'isAdmin' =>'admin',
            'creationDate' =>'created_at',
            'lastChange' =>'updated_at',
            'deletedDate' =>'deleted_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
