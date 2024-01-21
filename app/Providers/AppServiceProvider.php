<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\admin\AdminNavbar;
use App\Models\admin\UserProfile;
use App\Models\User;

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
        View::composer('*', function ($view) {
            $userProfileObj = new UserProfile();
            $navbars = AdminNavbar::get();
            $userProfile = $userProfileObj->getUserProfile(['user_id' => auth()->id()]);
            if (empty($userProfile)) {
                $user = new User();
                $user = $user->getUser(['user_type' => 'super-admin'])->first();
                $userProfile = $userProfileObj->getUserProfile(['user_id' => $user->id]);
            }
            $view->with('navbars', $navbars)->with('userProfile', $userProfile);
        });
    }
}
