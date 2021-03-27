<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allergy;
class AllergyController extends Controller
{
   /** start display  data */
   public function getAll(){
    $data=Allergy::paginate(5);
    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get Data list"
    ], 400);
}
 /** start display  data */
 public function getAllergies(){
    $data=Allergy::get();
    if ($data) {
        return response()->json($data);
    }
    return response()->json([
        "message" => "Couldn't get Data list"
    ], 400);
}


public function getById($id)
    {
        $data=Allergy::find($id);
        if(!$data){
            return response()->json(["message"=>"Couldn't Get Data"],400);
        }else{
            return response()->json($data);
        }
    }


   /** End display  data */

/**Search by Name */

public function searchByName($name){
    $data=Allergy::Where('name', 'like', '%' .$name . '%')->get();

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
    $data=Allergy::create([
        'name'=>$request->name,
        'desciption'=>$request->desciption,
        
     
 ]);
 return response()->json($data);
      
}

public function edit($id){
    $data=Allergy::find($id);
  if(!$data){
      return response()->json(["message"=>"Couldn't Get Data"],400);
  }else{
      return response()->json($data);
  }
}
public function update(Request $request , $id){
   //request Params
   $data=Allergy::find($id)->update([
      'name'=>$request->name,
     'desciption'=>$request->desciption,
     
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
    $data=Allergy::find($id)->delete();
    if(!$data){
      return response()->json(["message"=>"Couldn't Delete Data "],400);
  }else{
      return response()->json(["message"=>"Successfully Delete Data "],200);
  }
}



    /*CRUD */
}


