<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additive extends Model
{
    protected $table="additives";
    protected $fillables=['name','description'];
}
