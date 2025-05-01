<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Department;
use App\Models\Worker;

Route::post('/department', function(){
$department = new Department();
$department->name->input('name');
$department->description->input('description');
});
Route::post('/department', function(){
    $worker = new Worker();
    $worker->name->input('name');
    $worker->function->input('function');
    $worker->CPF->
    });
Route::get('/enterprise/{}', function ($id) {
    $enterprise = Enterprise::find($id);
    return response()-> json($enterprise);
});
Route::get('/enterprise/{}', function ($id) {
    $enterprise = Enterprise::find($id);
    return response()-> json($enterprise);
});
