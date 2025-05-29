<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Services\ProductServices;

class BookService

{
    private BookRepository $bookRepository;
    private ProductService $productService;

    public function __construct(BookRepository $bookRepository, ProductService $productService){
        $this->bookRepository = $bookRepository;
        $this->productService = $productService;
    }

    public function get(){
        $categories = $this->bookRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->bookRepository->details($id);
    }

    public function store(array $data){
        return $this->bookRepository->store($data);
    }

    public function update($id, $data){
        $book = $this->bookRepository->update($id,$data);
        return $book;

    }

    public function delete(int $id){
        $book = $this->details($id);
        $product = $book->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->bookRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->bookRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->bookRepository->findProducts($id);
    }

}