<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssignGuard extends BaseMiddleware
{
       /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        
        
        if ($guard == "superadmin" && Auth::guard($guard)->check()) {
        } else if ($guard == "schooladmin" && Auth::guard($guard)->check()) {
        } else if ($guard == "teacher" && Auth::guard($guard)->check()) {
        } else if ($guard == "student" && Auth::guard($guard)->check()) {
        } else {
            try{
          
                $admin=JWTAuth::parseToken()->authenticate();
                $request->merge(['Admin' => $admin]);
               
            }catch(Exception $e){
                if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['status'=>'Token is Invalid']);
                }
                else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['status'=>'Token is Expired']);
                }
    
                else{
                    return response()->json(['status'=>'Authorization Token not Found']);
                }
    
            }
        } 
        
   
  

       
       return $next($request); 
        


}
}
