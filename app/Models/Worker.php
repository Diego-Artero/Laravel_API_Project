<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Department;
class Worker extends Model
{
    protected $table = 'workers';
    protected $fillable = ['name','function','CPF','department_id'];

    public function department(){
        
        return $this->belongsTo(
            Department::class,
            'department_id',
            'id'
        ); 
        }

}
