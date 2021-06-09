<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // User login view
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // New user registration view
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // Reset user password request
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot');
        });

        // Reset password view
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset', [
                'request' => $request,
            ]);
        });

        // Verify email
        Fortify::verifyEmailView(function () {
            return view('auth.verify');
        });

        // Confirm password
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm');
        });

        // 2FA
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor');
        });

    }
}
