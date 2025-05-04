<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Department;
use App\Models\Worker;

Route::get('/workers', function () {
    return response()->json(Workers::all());
});

Route::post('/worker', function (Request $request) {
    $worker = new Workers();
    $worker->name = $request->input('name');
    $worker->CPF = $request->input('cpf');
    $worker->department_id = $request->input('department_id');
    $worker->save();
    return response()->json($worker, 201);
});

Route::get('/worker/{id}', function ($id) {
    return response()->json(Workers::findOrFail($id));
});

Route::put('/worker/{id}', function (Request $request, $id) {
    $worker = Workers::findOrFail($id);
    $worker->name = $request->input('name', $worker->name);
    $worker->CPF = $request->input('cpf', $worker->CPF);
    $worker->department_id = $request->input('department_id', $worker->department_id);
    $worker->save();
    return response()->json($worker);
});

Route::delete('/worker/{id}', function ($id) {
    $worker = Workers::findOrFail($id);
    $worker->delete();
    return response()->json(null, 204);
});

Route::get('/departments', function () {
    return response()->json(Department::all());
});

Route::post('/department', function (Request $request) {
    $department = new Department();
    $department->name = $request->input('name');
    $department->description = $request->input('description');
    $department->save();
    return response()->json($department, 201);
});

Route::get('/department/{id}', function ($id) {
    return response()->json(Department::findOrFail($id));
});

Route::put('/department/{id}', function (Request $request, $id) {
    $department = Department::findOrFail($id);
    $department->name = $request->input('name', $department->name);
    $department->description = $request->input('description', $department->description);
    $department->save();
    return response()->json($department);
});

Route::delete('/department/{id}', function ($id) {
    $department = Department::findOrFail($id);
    $department->delete();
    return response()->json(null, 204);
});


Route::get('/workers-with-departments', function () {
    return response()->json(Workers::with('department')->get());
});


Route::get('/departments-with-workers', function () {
    return response()->json(Department::with('workers')->get());
});


Route::get('/worker/{id}/department', function ($id) {
    $worker = Workers::with('department')->findOrFail($id);
    return response()->json($worker->department);
});


Route::get('/department/{id}/workers', function ($id) {
    $department = Department::with('workers')->findOrFail($id);
    return response()->json($department->workers);
});
