<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    protected $fillable   = ['score','product_id','nutri_id'];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
