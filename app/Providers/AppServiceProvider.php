<?php

namespace App\Providers;

use App\Enums\Roles;
use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use App\Models\Club\ClubReservations;
use App\Models\Food\Food;
use App\Models\Food\FoodReservation;
use App\Models\Store\Store;
use App\Models\Store\StoreCategory;
use App\Models\Store\StoreDiscount;
use App\Models\User\User;
use App\Models\User\UsersFamilymembersIds;
use App\Policies\Club\ClubPolicy;
use App\Policies\Club\ClubReservationPolicy;
use App\Policies\ClubCategory\ClubCategoryPolicy;
use App\Policies\Food\FoodPolicy;
use App\Policies\Food\FoodReservationPolicy;
use App\Policies\Store\StoreDiscountPolicy;
use App\Policies\Store\StorePolicy;
use App\Policies\StoreCategory\StoreCategoryPolicy;
use App\Policies\User\UserFamilyMembersPolicy;
use App\Policies\User\UserPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        Gate::before(function($user, $ability){
            return $user->hasRole(config('auth.super_admin')) ? true : null;
        });

        $this->policies();

        Model::preventLazyLoading(app()->isLocal());

        Paginator::useBootstrapFive();

        Relation::morphMap([
            'user' => 'App\Models\User\User',
            'permission' => 'Spatie\Permission\Models\Permission',
            'role' => 'Spatie\Permission\Models\Role',
        ]);
    }


    protected function policies()
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(UsersFamilymembersIds::class, UserFamilyMembersPolicy::class);

        Gate::policy(ClubCategory::class, ClubCategoryPolicy::class);
        Gate::policy(Club::class, ClubPolicy::class);
        Gate::policy(ClubReservations::class, ClubReservationPolicy::class);

        Gate::policy(StoreCategory::class, StoreCategoryPolicy::class);
        Gate::policy(Store::class, StorePolicy::class);
        Gate::policy(StoreDiscount::class, StoreDiscountPolicy::class);

        Gate::policy(Food::class, FoodPolicy::class);
        Gate::policy(FoodReservation::class, FoodReservationPolicy::class);
    }
}
