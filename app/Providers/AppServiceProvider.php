<?php

namespace App\Providers;

use App\Models\AdoptionDog;
use App\Models\Dog;
use App\Models\Event;
use App\Models\Park;
use App\Models\VeterinaryCenter;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Relation::enforceMorphMap([
            'adoption_dog' => AdoptionDog::class,
            'event'        => Event::class,
            'dog'          => Dog::class,
            'park'         => Park::class,
            'veterinary_center' => VeterinaryCenter::class,
        ]);
    }
}