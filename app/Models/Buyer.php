<?php

namespace App\Models;

use App\Scopes\BuyerScope;
use App\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
  
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
