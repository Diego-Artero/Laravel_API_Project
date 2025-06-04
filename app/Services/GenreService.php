<?php

namespace App\Services;

use App\Repositories\GenreRepository;
use App\Services\BookServices;

class GenreService

{
    private GenreRepository $genreRepository;
    private BookService $bookService;

    public function __construct(GenreRepository $genreRepository, BookService $bookService){
        $this->genreRepository = $genreRepository;
        $this->bookService = $bookService;
    }

    public function get(){
        $categories = $this->genreRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->genreRepository->details($id);
    }

    public function store(array $data){
        return $this->genreRepository->store($data);
    }

    public function update($id, $data){
        $genre = $this->genreRepository->update($id,$data);
        return $genre;

    }

    public function delete(int $id){
        $genre = $this->details($id);
        $books = $genre->books;
        
        foreach($books as $book){
            $this->bookService->delete($book->id);
        }
        return $this->genreRepository->delete($id);
    }

    public function getWithBooks(){
        return $this->genreRepository->getWithBooks();
    }

    public function findBooks(int $id){
        return $this->genreRepository->findBooks($id);
    }

}