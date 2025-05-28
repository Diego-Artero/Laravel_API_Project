<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Worker;
class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['name','description'];

    public function worker(){
        
        return $this->hasMany(
            Worker::class,
            'id',
            'id'
        ); 
        }
}
