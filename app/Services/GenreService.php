<?php

namespace App\Services;

use App\Repositories\GenreRepository;
use App\Services\ProductServices;

class GenreService

{
    private GenreRepository $genreRepository;
    private ProductService $productService;

    public function __construct(GenreRepository $genreRepository, ProductService $productService){
        $this->genreRepository = $genreRepository;
        $this->productService = $productService;
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
        $product = $genre->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->genreRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->genreRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->genreRepository->findProducts($id);
    }

}