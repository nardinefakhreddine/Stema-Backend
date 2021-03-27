<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additive_product extends Model
{
    protected $table="prod_additives";
    protected $fillable=['product_id','additive_id'];
    protected $hidden=['created_at','updated_at'];
}
