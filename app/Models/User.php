<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class User extends Model
{
    
    protected $table = 'users';
    protected $fillable = ['name','email','password'];
    //



    public function reviews(){
        return $this->hasMany(Review::class,'user_id','id');
    }
}
