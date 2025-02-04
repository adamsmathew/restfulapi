<?php

namespace App\Transformers;
use App\Models\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' =>(int)$buyer->id,
            'name' =>(string)$buyer->name,
            'email' =>(string)$buyer->email,
            'isVerified' =>(int)$buyer->verified,
            'creationDate' =>$buyer->created_at,
            'lastChange' =>$buyer->updated_at,
            'deletedDate' =>isset($buyer->deleted_at) ? (string) $buyer->deleted_at : null,

        ];
    }
    public function orginalAttribute($index)
    {
        $attributes = [
            'identifier' =>'id',
            'name' =>'name',
            'email' =>'email',
            'isVerified' =>'verified',
            'creationDate' =>'created_at',
            'lastChange' =>'updated_at',
            'deletedDate' =>'deleted_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
