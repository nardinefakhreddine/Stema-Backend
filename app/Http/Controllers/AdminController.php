<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function login(Request $request){

        $credentials = request(['username', 'password']);

        if (!$token = auth('admins')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    







 protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('admins')->factory()->getTTL() * 60,
            'admin'=>auth('admins')->user(),
            'adminID'=>auth('admins')->user()->id,
            'role'=>'admin'
        ]);
    }

}