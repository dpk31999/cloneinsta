<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(auth()->user()){
            $user_id = auth()->user()->id;
            $profile = DB::table('profiles')->where('user_id', $user_id)->first();
            if($profile == null){
                return redirect('/completeprofile');
            }
        }
        return $next($request);
    }
}
