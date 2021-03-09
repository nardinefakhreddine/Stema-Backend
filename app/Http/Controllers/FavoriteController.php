<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
class FavoriteController extends Controller
{
    public function get($id){
        $data=Favorite::where('user_id',$id)->get();
        if ($data) {
            return response()->json($data);
        }
        return response()->json([
            "message" => "Couldn't get Data list"
        ], 400);
    }

 public function create($productID,$userID){
    $data=Favorite::create([
        'user_id'=>$request->user_id,
        'product_id'=>$request->product_id,
        
     
 ]);
 return response()->json($data);
      
 }

 public function delete($productID,$userID){
    $data=Favorite::where('product_id',$productID)->where('user_id',$userID)->delete();
    if(!$data){
      return response()->json(["message"=>"Couldn't Delete Data "],400);
  }else{
      return response()->json(["message"=>"Successfully Delete Data "],200);
  }
}
}