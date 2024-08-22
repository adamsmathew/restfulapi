<?php
namespace App\Models;
use App\Models\Buyer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'buyer_id',  
        'product_id'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
