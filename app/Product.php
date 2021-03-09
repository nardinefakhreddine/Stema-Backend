<?php

namespace App;
use App\Score;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $fillables=['name','barecode','brand','description','image','score_id'];
    protected $hidden=['created_at','updated_at'];
    public function scores(){
        return $this->belongsTo(Score::class,'score_id');
    }
}
