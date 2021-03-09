<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nutriFact extends Model
{
    protected $table="nutritional_facts";
    protected $fillables=['name','description'];
    protected $hidden=['created_at','updated_at'];
}

