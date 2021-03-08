<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Http\Requests\Login\UserRequest;
class UserController extends Controller
{
   
        
/**  START Login AND LOGOUT **/
    public function login(UserRequest $request){

        $credentials = request(['username', 'password']);

        if (!$token = auth('jwtusers')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('jwtusers')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    
/**  END Login AND LOGOUT **/


/** Start Dispaly Data **/
    public function getAll(){
        $users=User::all();
        if ($users) {
            return response()->json($users);
        }
        return response()->json([
            "message" => "Couldn't get users list"
        ], 400);
    }

    public function getById($id)
    {
        $user=User::find($id);
        if(!$user){
            return response()->json(["message"=>"Couldn't Get  User"],400);
        }else{
            return response()->json($user);
        }
    }
/** END Dispaly Data **/
    


 /**Start CRUD**/
 public function create(Request $request){
    $user=User::create([
     'name'=>$request->name,
     'phone'=>$request->phone,
     'username'=>$request->username,
     'email'=>$request->email,
     'password'=>$request->password,
     
 ]);
 return response()->json($user);
      
}

public function edit($id){
    $user=User::find($id);
  if(!$user){
      return response()->json(["message"=>"Couldn't Get User"],400);
  }else{
      return response()->json($user);
  }
}
public function update(Request $request , $id){
   $user=User::find($id)->update([
      'name'=>$request->name,
     'username'=>$request->username,
     'phone'=>$request->phone,
     'email'=>$request->email,
     'password'=>$request->password,
  ]);

  if ($user) {
      return response()->json([
          "message" => " User successfully updated"
      ], 200);
  }
  return response()->json([
      "message" => "Couldn't update  User"
  ], 400);
       
}

public function delete($id){
    $user=User::find($id)->delete();
    if(!$user){
      return response()->json(["message"=>"Couldn't Delete User"],400);
  }else{
      return response()->json(["message"=>"Successfully Delete  User"],200);
  }
}
/**END CRUD**/

/*some used funtions */
 protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('jwtusers')->factory()->getTTL() * 60,
            'user'=>auth('jwtusers')->user(),
            'userID'=>auth('jwtusers')->user()->id,
            'role'=>'user'
        ]);
    }

}
