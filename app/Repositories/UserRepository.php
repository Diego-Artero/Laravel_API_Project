<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function get(){
        return User::all();
    }

    public function details(int $id){
        return User::findOrFail($id);
    }

    public function store(array $data){
        return User::create($data);
    }

    public function update(int $id, array $data){
        $user = $this->details($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id){
        $user = $this->details($id);
        $user->delete();
        return $user;
    }

    public function findReviews(int $id){
        $user = $this->details($id);
        return $user->review;
    }
}