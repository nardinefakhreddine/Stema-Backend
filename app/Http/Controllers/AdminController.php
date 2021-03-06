<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    public function getAll(){
        $users=Admin::all();
        if ($users) {
            return response()->json($users);
        }
        return response()->json([
            "message" => "Couldn't get users list"
        ], 400);
    }

    
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