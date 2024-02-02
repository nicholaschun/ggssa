<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Filament\Facades\Filament;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       'Spatie\Permission\Models\Role' =>  RolePolicy::class,
        'Spatie\Permission\Models\Permission' => PermissionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
