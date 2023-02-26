<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Session;
use DB;
class userlogin
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
        $user_id = Session::get('user_id');
        if (!isset($user_id)) {
            return redirect('/login')->send();
        }else{
            $user = DB::table('users')->where('id',$user_id)->first();
            unset($user->password);
            $user->avatar = DB::table('medias')->where('id',$user->avatar)->first();
            $array = array('user' => $user);
            Session::flash('userData',$user);
            return $next($request);
        }
        
    }
}
