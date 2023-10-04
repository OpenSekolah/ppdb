<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        if(request()->is('manager/*')){
            return Inertia::location(route('manager.dashboard'));
        } else {
            return Inertia::location(route('dashboard'));
        }	

        // if (request()->is('manager/*')) {
        //     return redirect()->intended(route('manager.login'));
        // }
        // return redirect()->intended(Fortify::redirects('login'));
    }

}