<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutReseponseContract;
use Inertia\Inertia;

class LogoutReseponse implements LogoutReseponseContract{


    public function toResponse($request)
    {
        if(request()->is('manager/*') || request()->is('manager')){
            return Inertia::location(route('manager.login'));
        } else {
            return Inertia::location(route('login'));
        }  
    }

}