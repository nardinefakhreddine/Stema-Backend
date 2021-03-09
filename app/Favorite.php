<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table="favorites";
    protected $fillables=['user_id','product_id'];
}
