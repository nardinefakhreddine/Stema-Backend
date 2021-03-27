<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy_product extends Model
{
    protected $table="prod_allergies";
    protected $fillable=['product_id','allergy_id'];
    protected $hidden=['created_at','updated_at'];
}
