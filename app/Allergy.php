<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    protected $table="allergies";
    protected $fillables=['name','description'];
}
