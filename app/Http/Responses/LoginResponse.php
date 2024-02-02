<?php
 
namespace App\Http\Responses;
 
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
 
class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {

        if(!Filament::auth()->user()['profile_set']) {
           redirect()->intended('/settings');
        }
 
        
    }
}