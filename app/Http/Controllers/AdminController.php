<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    
    
/**  START Login AND LOGOUT **/
    public function login(Request $request){
         $credentials = request(['username', 'password']);
          if (!$token = auth('admins')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('admins')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
/**  END Login && LOGOUT **/



/** Start Dispaly Data **/
    public function getAll(){
        $users=Admin::all();
        if ($users) {
            return response()->json($users);
        }
        return response()->json([
            "message" => "Couldn't get users list"
        ], 400);
    }

    public function getById($id)
    {
        $admin=Admin::find($id);
        if(!$admin){
            return response()->json(["message"=>"Couldn't Get Admin"],400);
        }else{
            return response()->json($admin);
        }
    }
    /** END Dispaly Data **/



   /**Start CRUD**/
  public function create(Request $request){
      //request body
   $admin=Admin::create([
       'name'=>$request->name,
       'username'=>$request->username,
       'email'=>$request->email,
       'password'=>$request->password,

       
   ]);
   return response()->json($admin);
        
  }

  public function edit($id){
    $admin=Admin::find($id);
    if(!$admin){
        return response()->json(["message"=>"Couldn't Get Admin"],400);
    }else{
        return response()->json($admin);
    }
  }
 public function update(Request $request , $id){
     //request Params
    $admin=Admin::find($id)->update([
        'name'=>$request->name,
       'username'=>$request->username,
       'email'=>$request->email,
       'password'=>$request->password,
    ]);
  
    if ($admin) {
        return response()->json([
            "message" => "Admin successfully updated"
        ], 200);
    }
    return response()->json([
        "message" => "Couldn't update Admin"
    ], 400);
         
  }

  public function delete($id){
      $admin=Admin::find($id)->delete();
      if(!$admin){
        return response()->json(["message"=>"Couldn't Delete Admin"],400);
    }else{
        return response()->json(["message"=>"Successfully Delete Admin"],200);
    }
}


  /**END CRUD**/


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