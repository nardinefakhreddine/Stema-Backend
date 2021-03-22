<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Product;
 use App\Score;
 use App\Prod_Nutri;
 use App\nutriFact;
 use  Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
   /* Start Dispalying Data*/
   public function getAll(){
    $data=Product::with('scores')->paginate(5);
    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get users list"
    ], 400);
}

public function getById($id){
    $data=Product::with('scores')->find($id);
    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get users list"
    ], 400);
}



public function getByBarecode($barecode){
    $data=Product::with('scores')->where('barecode',$barecode)->get();
    if (!$data) {
        return response()->json([
            "message" => "Couldn't get product list"
        ], 400);
        
    }
    return response()->json($data);

}
   

   /*End Displaying Data */
/* Start Display products with score and All nutri Info  */
public function searchByName($name){
    $data=Product::with('scores')->Where('name', 'like', '%' .$name . '%')->paginate(5);

    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get product list"
    ], 400);
    
}




public function display($productID){
    $products=Product::where('id',$productID)->get();
    $resArray=array();
    foreach($products as $val){
        $data['name']=$val->name;
        $data['description']=$val->description;
        $data['brand']=$val->brand;

        $score=Score::where('id',$val->score_id)->first();
        if(!$score==[]){
            $data['score']=$score->name;
            $data['scoreInfo']=$score->descripion;
            }

            $nutri = DB::table('products')
            ->join('prod_nutritionals', 'products.id', '=', 'prod_nutritionals.product_id')
            ->join('nutritional_facts', 'nutritional_facts.id', '=', 'prod_nutritionals.nutri_id')
            ->where('products.id',$val->id)
            ->select('prod_nutritionals.scale', 'nutritional_facts.name','nutritional_facts.desciption')
            ->get();
    
            $data['nutri']=$nutri;
             $allergies=DB::table('products')
             ->join('prod_allergies', 'products.id', '=', 'prod_allergies.product_id')
             ->join('allergies', 'allergies.id', '=', 'prod_allergies.allergy_id')
             ->where('products.id',$val->id)
             ->select('allergies.id','allergies.name','allergies.desciption')
             ->get();
             $data['allergies']=$allergies;
             $additives=DB::table('products')
             ->join('prod_additives', 'products.id', '=', 'prod_additives.product_id')
             ->join('additives', 'additives.id', '=', 'prod_additives.additive_id')
             ->where('products.id',$val->id)
             ->select('additives.id','additives.name','additives.desciption')
             ->get();
             $data['additives']=$additives;
            array_push($resArray,$data);    
    }
    return response()->json($resArray);
}


public function displayByBareCode($barecode){
    $products=Product::where('barecode',$barecode)->get();
    $resArray=array();
    foreach($products as $val){
        $data['id']=$val->id;
        $data['barecode']=$val->barecode;
        $data['name']=$val->name;
        $data['description']=$val->description;
        $data['brand']=$val->brand;

        $score=Score::where('id',$val->score_id)->first();
        if(!$score==[]){
            $data['score']=$score->name;
            $data['scoreInfo']=$score->descripion;
            }

            $nutri = DB::table('products')
            ->join('prod_nutritionals', 'products.id', '=', 'prod_nutritionals.product_id')
            ->join('nutritional_facts', 'nutritional_facts.id', '=', 'prod_nutritionals.nutri_id')
            ->where('products.id',$val->id)
            ->select('prod_nutritionals.scale', 'nutritional_facts.name','nutritional_facts.desciption')
            ->get();
    
            $data['nutri']=$nutri;
             $allergies=DB::table('products')
             ->join('prod_allergies', 'products.id', '=', 'prod_allergies.product_id')
             ->join('allergies', 'allergies.id', '=', 'prod_allergies.allergy_id')
             ->where('products.id',$val->id)
             ->select('allergies.id','allergies.name','allergies.desciption')
             ->get();
             $data['allergies']=$allergies;
             $additives=DB::table('products')
             ->join('prod_additives', 'products.id', '=', 'prod_additives.product_id')
             ->join('additives', 'additives.id', '=', 'prod_additives.additive_id')
             ->where('products.id',$val->id)
             ->select('additives.id','additives.name','additives.desciption')
             ->get();
             $data['additives']=$additives;
            array_push($resArray,$data);    
    
        }
            return response()->json($resArray);
}
/* End Display products with score and All nutri Info  */


     /*Start Crud */
       public function Insert(Request $request){
        $data=Product::create([
            'barecode'=>$request->barecode,
            'name'=>$request->name,
            'score_id'=>$request->score_id,
            'brand'=>$request->brand,
             'description'=>$request->description,
             'image'=>$request->image,
        
        ]);
        return response()->json($data);
       }
      public function getScores(){
          $data=Score::all();
          return response()->json($data);
      }

       public function edit(Request $request,$id){
        $data=Product::with('scores')->find($id);
        if(! $data){
            return response()->json(["message"=>"Couldn't Get  data"],400);
        }else{
            return response()->json( $data);
        }
    }

    public function update(Request $request , $id){
        $data=Product::find($id)->update([
            'barecode'=>$request->barecode,
            'name'=>$request->name,
            'score_id'=>$request->score_id,
            'brand'=>$request->brand,
            'description'=>$request->description,
  ]);
  if ( $data) {
      return response()->json([
          "message" => " Product successfully updated"
      ], 200);
  }
  return response()->json([
      "message" => "Couldn't update  Product"
  ], 400);
       
    }

    public function delete($id){
        $data=Product::find($id)->delete();
        if(!$data){
          return response()->json(["message"=>"Couldn't Delete Product"],400);
      }else{
          return response()->json(["message"=>"Successfully Delete Product"],200);
      }
    }

    
     /*End Crud */

}
