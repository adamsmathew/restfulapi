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
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Define the relationship with the User model for products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
