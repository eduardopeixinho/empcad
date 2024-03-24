<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class SocialiteLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function googleCallBack(Request $request){

        $googleUser = Socialite::driver('google')->user();
        $email = $googleUser->email;
/*
        $user_check = User::where('email', 'like',  $email)
                        ->first();

        if($user_check){
            $previousData = $user_check->toArray();  
        }else{
            $previousData = [];  
        }         
*/
//dd($googleUser);
        $user = User::query()->updateOrCreate(
            ['email' => $googleUser->email],
            [
                'id_google' => $googleUser->id,
                'nickname' => $googleUser->nickname,
                'name' => $googleUser->name,
                'avatar' => $googleUser->avatar,
                ]
        );        

        $currentData = $user->toArray();

        $changes = [];

 /*       foreach ($currentData as $field => $currentValue) {
            if (isset($previousData[$field]) && $previousData[$field] !== $currentValue) {
                $changes[$field] = [
                    'previous' => $previousData[$field],
                    'current' => $currentValue,
                ];
            }
        }
*/


        Auth::login($user);
        
        
      //  event(new LoginHistory($user));

        return redirect()->route('home');        




    }
}
