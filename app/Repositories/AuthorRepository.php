<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function get(){
        return Author::all();
    }

    public function details(int $id){
        return Author::findOrFail($id);
    }

    public function store(array $data){
        return Author::create($data);
    }

    public function update(int $id, array $data){
        $author = $this->details($id);
        $author->update($data);
        return $author;
    }

    public function delete(int $id){
        $author = $this->details($id);
        $author->delete();
        return $author;
    }
    
    public function getWithProducts(){
        $authors = Author::with('products')->get();
        return $authors;
    }

    public function findProducts(int $id){
        $author = $this->details($id);
        return $author->products;
    }
}