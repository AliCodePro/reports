<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use  Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use App\Models\Role;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $this->cacheRolesAndPermissions();
    }

    protected function cacheRolesAndPermissions()
    {
        $roles = Cache::rememberForever('roles', function () {
            return Role::with('permissions')->get();
        });

        $roles = Role::with('permissions')->get();


        $permissionsArray = [];

        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                $permissionsArray[$permission->title][] = $role->id;
            }
        }

        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function ($user) use ($roles) {
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }
    }

    public function register(): void
    {
        parent::register();

        // Listen for role and permission events
        Role::created([$this, 'invalidateRolesAndPermissionsCache']);
        Role::updated([$this, 'invalidateRolesAndPermissionsCache']);
        Role::deleted([$this, 'invalidateRolesAndPermissionsCache']);

        Permission::created([$this, 'invalidateRolesAndPermissionsCache']);
        Permission::updated([$this, 'invalidateRolesAndPermissionsCache']);
        Permission::deleted([$this, 'invalidateRolesAndPermissionsCache']);
    }

    public function invalidateRolesAndPermissionsCache()
    {
        Cache::forget('roles');
    }
}
