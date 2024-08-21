<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seller = User::has('products')->inRandomOrder()->first();
        $buyer = User::where('id', '!=', $seller->id)->inRandomOrder()->first();

        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'buyer_id' => $buyer->id,
            'product_id' => $seller->products->random()->id,
        ];
    }
}
