<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prod_Nutri;
use  Illuminate\Support\Facades\DB;
class NutriproductController extends Controller
{
    public function create(Request $request){
        //request body
        $data=Prod_Nutri::create([
            'product_id'=>$request->product_id,
            'nutri_id'=>$request->nutri_id,
            'scale'=>$request->scale
            
         
     ]);
     return response()->json($data);
          
    }
    public function getNutri($id){
       $nutri = DB::table('products')
            ->join('prod_nutritionals', 'products.id', '=', 'prod_nutritionals.product_id')
            ->join('nutritional_facts', 'nutritional_facts.id', '=', 'prod_nutritionals.nutri_id')
            ->where('products.id',$id)
            ->select('prod_nutritionals.id','prod_nutritionals.scale', 'nutritional_facts.name','nutritional_facts.desciption')
            ->get();
            return response()->json($nutri);
    }
  
}
