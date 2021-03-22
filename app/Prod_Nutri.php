<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod_Nutri extends Model
{
    protected $table="prod_nutritionals";
    protected $fillable=['product_id','nutri_id','scale'];
    protected $hidden=['created_at','updated_at'];
}