<?php

namespace App\Transformers;
use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'identifier' =>(int)$category->id,
            'title' =>(string)$category->name,
            'details' =>(string)$category->description,
            'creationDate' =>$category->created_at,
            'lastChange' =>$category->updated_at,
            'deletedDate' =>isset($category->deleted_at) ? (string) $category->deleted_at : null,
           
            'link'=> 
            [
                'rel' =>'self',
                'href' =>route('categories.show',$category->id),
            ],

            [
            'rel' =>'category.buyers',
                'href' =>route('categories.buyers.index',$category->id),
            ],

            [
                'rel' =>'category.products',
                    'href' =>route('categories.products.index',$category->id),
            ],
            [
                'rel' =>'category.sellers',
                    'href' =>route('categories.products.index',$category->id),
            ],
            [
                'rel' =>'category.transactions',
                    'href' =>route('categories.transactions.index',$category->id),
            ],
        ];
    }
    public function orginalAttribute($index)
    {
        $attributes = [
            'identifier' =>'id',
            'title' =>'name',
            'details' =>'description',
            'creationDate' =>'created_at',
            'lastChange' =>'updated_at',
            'deletedDate' =>'deleted_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
