<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allergy_product;
use  Illuminate\Support\Facades\DB;
class AllergyproductController extends Controller
{
    public function create(Request $request){
        //request body
        $data=Allergy_product::create([
            'product_id'=>$request->product_id,
            'allergy_id'=>$request->allergy_id,
            
            
         
     ]);
     return response()->json($data);
          
    }
    public function getAllergy($id){
       $allergy = DB::table('products')
            ->join('prod_allergies', 'products.id', '=', 'prod_allergies.product_id')
            ->join('allergies', 'allergies.id', '=', 'prod_allergies.allergy_id')
            ->where('products.id',$id)
            ->select('allergies.id', 'allergies.name','allergies.desciption')
            ->get();
            return response()->json($allergy);
    }
}
