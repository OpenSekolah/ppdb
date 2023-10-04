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
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use App\Models\Manager;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (request()->is('manager/*') || request()->is('manager')) {
            config()->set('fortify.guard', 'manager');
            config()->set('fortify.passwords', 'managers');
            config()->set('fortify.home', 'manager/');
            config()->set('fortify.prefix', 'manager.');
            config()->set('fortify.path', 'Managers');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        if(request()->is('manager/*') || request()->is('manager')) {
            Fortify::loginView(function () {
                return Inertia::render('Managers/Auth/Login',[
                    'canResetPassword' => Route::has('manager.password.request'),
                    'status' => session('status'),
                ]);
            });
            
            Fortify::authenticateUsing(function (LoginRequest $request) {
                $user = Manager::where(function($query) use ($request) {
                        $query->where('email', $request->email)
                            ->whereIn('role', ['admin', 'super-admin']);
                    })
                    ->first();

                if ($user && Hash::check($request->password, $user->password)) {
                    if($user->is_active == 1) {
                        return $user;
                    } else {
                        throw ValidationException::withMessages([
                            Fortify::email() => "Akun Anda belum diaktifkan.",
                        ]);
                    }
                } else {
                    throw ValidationException::withMessages([
                        Fortify::email() => "Kredensial ini tidak cocok dengan catatan kami.",
                    ]);
                }
            });
        } else {
            Fortify::loginView(function () {
                return Inertia::render('Auth/Login', [
                    'canResetPassword' => false,
                    'status' => session('status'),
                ]);
            });
        }

        

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
