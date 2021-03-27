<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Additive_product;
use  Illuminate\Support\Facades\DB;
class AdditiveproductController extends Controller
{
    public function create(Request $request){
        //request body
        $data=Additive_product::create([
            'product_id'=>$request->product_id,
            'additive_id'=>$request->additive_id,
           
            
         
     ]);
     return response()->json($data);
          
    }
    public function getAdditive($id){
       $additives = DB::table('products')
            ->join('prod_additives', 'products.id', '=', 'prod_additives.product_id')
            ->join('additives', 'additives.id', '=', 'prod_additives.additive_id')
            ->where('products.id',$id)
            ->select('additives.id', 'additives.name','additives.desciption')
            ->get();
            return response()->json($additives);
    }
}
