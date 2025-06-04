<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function get(){
        return Genre::all();
    }

    public function details(int $id){
        return Genre::findOrFail($id);
    }

    public function store(array $data){
        return Genre::create($data);
    }

    public function update(int $id, array $data){
        $genre = $this->details($id);
        $genre->update($data);
        return $genre;
    }

    public function delete(int $id){
        $genre = $this->details($id);
        $genre->delete();
        return $genre;
    }
    
    public function getWithBooks(){
        $genres = Genre::with('books')->get();
        return $genres;
    }

    public function findBooks(int $id){
        $genre = $this->details($id);
        return $genre->books;
    }
}