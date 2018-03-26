<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Enterprise\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // $permissions = Permission::select('id')->get();

        $gate->before(function ($user, $ability) {
            if ($user->id == 1 || $user->id == 3 || $user->id == 5 || $user->id == 117) {
                return true;
            }

            return $this->can($user, $ability);
        });

        // foreach ($permissions as $permission) {
        //     $gate->define($permission->id, function ($user, $permission) {
        //         return $this->can($user, $permission);
        //     });
        // }
    }

    private function can($user, $permission) {
        $permissions = $user->permissions->keyBy('id');

        if (isset($permissions[$permission])) {
            if ($permissions[$permission]->pivot->value == 0) {
                return true;
            } else if ($permissions[$permission]->pivot->value == 1) {
                return false;
            }
        }

        $roles = $user->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions->keyBy('id');

            if (isset($permissions[$permission])) {
                if ($permissions[$permission]->pivot->value == 0) {
                    return true;
                } else if ($permissions[$permission]->pivot->value == 1) {
                    return false;
                }
            }
        }

        return false;
    }
}
