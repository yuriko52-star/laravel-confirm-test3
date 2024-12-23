<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
// use App\Actions\Fortify\CustomLogoutResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
// use Laravel\Fortify\Fortify;
// use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //  $this->app->singleton(\Laravel\Fortify\Contracts\LogoutResponse::class, CustomLogoutResponse::class);    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
       
        //  Fortify::registerView(function () {
            // return redirect('/register/step1');
        // });

        // Fortify::loginView(function () {
            // return view('auth.login');
        // });
        

        RateLimiter::for('login', function (Request $request) {
           /* $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());*/
            // $email = (string) $request->email;

            // return Limit::perMinute(10)->by($throttleKey);
            // return Limit::perMinute(10)->by($email . $request->ip());

        });

        // $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);


        // RateLimiter::for('two-factor', function (Request $request) {
            // return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });
    }
}
