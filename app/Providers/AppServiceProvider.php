<?php

namespace App\Providers;

use App\Models\Admin\Admin;
use App\Models\Admin\Permission\AdminPermission;
use App\Models\Admin\Permission\AdminPermissionRole;
use App\Models\Admin\Permission\AdminRole;
use App\Observers\Admin\AdminObserver;
use App\Observers\Admin\AdminPermissionObserver;
use App\Observers\Admin\AdminPermissionRoleObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Admin::observe(AdminObserver::class);
        AdminRole::observe(AdminObserver::class);
        AdminPermission::observe(AdminPermissionObserver::class);
        AdminPermissionRole::observe(AdminPermissionRoleObserver::class);
        Resource::withoutWrapping();
    }
}
