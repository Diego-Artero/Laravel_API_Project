<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Services\ProductServices;

class AuthorService

{
    private AuthorRepository $authorRepository;
    private ProductService $productService;

    public function __construct(AuthorRepository $authorRepository, ProductService $productService){
        $this->authorRepository = $authorRepository;
        $this->productService = $productService;
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
        $product = $author->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->authorRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->authorRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->authorRepository->findProducts($id);
    }

}