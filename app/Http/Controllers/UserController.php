<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
class UserController extends Controller
{
    public function getAll(){
        $users=User::all();
        if ($users) {
            return response()->json($users);
        }
        return response()->json([
            "message" => "Couldn't get users list"
        ], 400);
    }
    
    public function login(Request $request){

        $credentials = request(['username', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    







 protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
            'user'=>auth('api')->user(),
            'userID'=>auth('api')->user()->id,
            'role'=>'user'
        ]);
    }

}
