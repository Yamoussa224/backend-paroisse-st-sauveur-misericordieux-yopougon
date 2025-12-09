<?php

namespace App\Providers;

use App\Repositories\NewRepository;
use App\Repositories\MessRepository;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use App\Repositories\ListenRepository;
use App\Repositories\PastorRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DonationRepository;
use App\Repositories\TimeSlotRepository;
use App\Repositories\MediationRepository;
use App\Repositories\ProgrammationRepository;
use App\Repositories\Contracts\NewRepositoryInterface;
use App\Repositories\Contracts\MessRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Contracts\ListenRepositoryInterface;
use App\Repositories\Contracts\PastorRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\DonationRepositoryInterface;
use App\Repositories\Contracts\TimeSlotRepositoryInterface;
use App\Repositories\Contracts\MediationRepositoryInterface;
use App\Repositories\Contracts\ProgrammationRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(ListenRepositoryInterface::class, ListenRepository::class);
        $this->app->bind(MediationRepositoryInterface::class, MediationRepository::class);
        $this->app->bind(MessRepositoryInterface::class, MessRepository::class);
        $this->app->bind(NewRepositoryInterface::class, NewRepository::class);
        $this->app->bind(PastorRepositoryInterface::class, PastorRepository::class);
        $this->app->bind(ProgrammationRepositoryInterface::class, ProgrammationRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TimeSlotRepositoryInterface::class, TimeSlotRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
