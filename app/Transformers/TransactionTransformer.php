<?php

namespace App\Transformers;

use App\Models\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
    public function transform(Transaction $transaction)
    {
        return [
            'identifier' =>(int)$transaction->id,
            'quantity' =>(string)$transaction->quantity,
            'buyer' =>(string)$transaction->buyer_id,
            'product' =>(int)$transaction->product_id,
            'creationDate' =>$transaction->created_at,
            'lastChange' =>$transaction->updated_at,
            'deletedDate' =>isset($transaction->deleted_at) ? (string) $transaction->deleted_at : null,

            'link'=> 
            [
                'rel' =>'self',
                'href' =>route('transactions.show',$transaction->id),
            ],

            [
                 'rel' =>'transaction.categories',
                'href' =>route('transactions.categories.index',$transaction->id),
            ],

            [
                    'rel' =>'transaction.seller',
                    'href' =>route('transactions.seller.index',$transaction->id),
            ],
            [
                'rel' =>'buyer',
                 'href' =>route('buyers.show',$transaction->buyer_id),
            ],
           
            [
                   'rel' =>'product',
                    'href' =>route('product.show',$transaction->product_id),
            ],
        ];
    }
    public function orginalAttribute($index)
    {
        $attributes = [
            'identifier' =>'id',
            'quantity' =>'quantity',
            'buyer' =>'buyer_id',
            'product' =>'product_id',
            'creationDate' =>'created_at',
            'lastChange' =>'updated_at',
            'deletedDate' =>'deleted_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
