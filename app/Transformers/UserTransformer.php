<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
    public function transform(User $user)
    {
        return [
            'identifier' =>(int)$user->id,
            'name' =>(string)$user->name,
            'email' =>(string)$user->email,
            'isVerified' =>(int)$user->verified,
            'isAdmin' =>($user->admin ==='true'),
            'creationDate' =>$user->created_at,
            'lastChange' =>$user->updated_at,
            'deletedDate' =>isset($user->deleted_at) ? (string) $user->deleted_at : null,

            'link'=> 
            [
                'rel' =>'self',
                'href' =>route('users.show',$user->id),
            ],

        ];
    }


    public function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'name' => 'name',
            'email' => 'email',
            'isVerified' => 'verified',
            'isAdmin' => 'admin',
            'creationDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
