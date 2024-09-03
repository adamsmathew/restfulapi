<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Seller;
use App\Scopes\SellerScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\SellerTransformer;


class Seller extends Model
{

    use HasFactory;

    protected $table ='users';

    public $transformer = SellerTransformer::class;


   protected static function boot()
    {
      parent::boot();

      static::addGlobalScope(new SellerScope);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

