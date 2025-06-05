<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Author;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['title','synopsis', 'genre_id','author_id'];

    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id','id');
    }
    public function reviews(){
        return $this->hasMany(Review::class,'book_id', 'id');
    }
    public function author(){
        return $this->belongsTo(Author::class,'author_id', 'id');

    }
}
