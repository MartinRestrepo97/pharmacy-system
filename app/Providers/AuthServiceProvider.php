<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Policies\CustomerPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SalePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Sale::class => SalePolicy::class,
        Product::class => ProductPolicy::class,
        Customer::class => CustomerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define additional gates if needed
        Gate::define('manage-all-sales', function ($user) {
            return $user->hasRole('admin') || $user->hasPermissionTo('manage all sales');
        });
    }
}