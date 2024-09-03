<?php

namespace App\Models;

use App\Scopes\BuyerScope;
use App\Transactions;
use App\Transformers\BuyerTransformer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
  
    public $transformer = BuyerTransformer::class;

    protected $table ='users';

    protected static function boot()
    {
      parent::boot();

      static::addGlobalScope(new BuyerScope);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
