<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $fillables=['name','barecode','brand','description','image','score_id'];
}
