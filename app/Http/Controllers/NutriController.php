<?php

namespace App\Http\Controllers;
use App\Prod_Nutri;
use App\nutriFact;
use Illuminate\Http\Request;

class NutriController extends Controller
{
   /** start display  data */
   public function getAll(){
    $data=nutriFact::paginate(5);
    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get Data list"
    ], 400);
}

public function getById($id)
    {
        $data=nutriFact::find($id);
        if(!$data){
            return response()->json(["message"=>"Couldn't Get Data"],400);
        }else{
            return response()->json($data);
        }
    }


   /** End display  data */
/**Search by Name */

public function searchByName($name){
    $data=nutriFact::Where('name', 'like', '%' .$name . '%')->get();

    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get product list"
    ], 400);
    
}


   /*CRUD */
   public function create(Request $request){
    //request body
    $data=nutriFact::create([
        'name'=>$request->name,
        'desciption'=>$request->desciption,
        
     
 ]);
 return response()->json($data);
      
}

public function edit($id){
    $data=nutriFact::find($id);
  if(!$data){
      return response()->json(["message"=>"Couldn't Get Data"],400);
  }else{
      return response()->json($data);
  }
}
public function update(Request $request , $id){
   //request Params
   $data=nutriFact::find($id)->update([
      'name'=>$request->name,
     'desciption'=>$request->description,
     
  ]);

  if ($data) {
      return response()->json([
          "message" => "Data successfully updated"
      ], 200);
  }
  return response()->json([
      "message" => "Couldn't update Data"
  ], 400);
       
}

public function delete($id){
    $data=nutriFact::find($id)->delete();
    if(!$data){
      return response()->json(["message"=>"Couldn't Delete Data "],400);
  }else{
      return response()->json(["message"=>"Successfully Delete Data "],200);
  }
}



    /*CRUD */
}
