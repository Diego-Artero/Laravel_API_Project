<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Services\BookServices;

class AuthorService

{
    private AuthorRepository $authorRepository;
    private BookService $bookService;

    public function __construct(AuthorRepository $authorRepository, BookService $bookService){
        $this->authorRepository = $authorRepository;
        $this->bookService = $bookService;
    }

    public function get(){
        $categories = $this->authorRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->authorRepository->details($id);
    }

    public function store(array $data){
        return $this->authorRepository->store($data);
    }

    public function update($id, $data){
        $author = $this->authorRepository->update($id,$data);
        return $author;

    }

    public function delete(int $id){
        $author = $this->details($id);
        $book = $author->books;
        
        foreach($books as $book){
            $this->bookService->delete($book->id);
        }
        return $this->authorRepository->delete($id);
    }

    public function getWithBooks(){
        return $this->authorRepository->getWithBooks();
    }

    public function findBooks(int $id){
        return $this->authorRepository->findBooks($id);
    }

}