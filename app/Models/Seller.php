<?php

namespace App\Models;

use App\Models\Product;
use App\Scopes\SellerScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{

    use HasFactory;

    protected $table ='users';

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

