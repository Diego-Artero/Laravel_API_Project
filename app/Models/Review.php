<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;
class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['grade','justificative','user_id', 'book_id'];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }
}
