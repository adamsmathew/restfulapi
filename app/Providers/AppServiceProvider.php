<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Product;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        User::updated(function($user) {
            if ($user->isDirty('email')) {
                Mail::to($user->email)->send(new UserCreated($user));
            }
        });

        User::updated(function($user){
            if($user->isDirty('email')) 
            Mail::to($user)->send(new UserCreated($user));
        });

        Product::updated(function($product){

        
            if ($product->quantity == 0 && $product->isAvailable()){
                $product->status = Product::UNAVAILABLE_PRODUCT;

                $product->save(); 
            }


        //  Passport::routes();   
        });
    }  
    

        // Schema::defaultStringLength(191);
        // // Optional: Set default charset and collation
        // Schema::defaultCharset('utf8');
        // Schema::defaultCollation('utf8_unicode_ci');
}

