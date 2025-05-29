<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use App\Services\ProductServices;

class ReviewService

{
    private ReviewRepository $reviewRepository;
    private ProductService $productService;

    public function __construct(ReviewRepository $reviewRepository, ProductService $productService){
        $this->reviewRepository = $reviewRepository;
        $this->productService = $productService;
    }

    public function get(){
        $categories = $this->reviewRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->reviewRepository->details($id);
    }

    public function store(array $data){
        return $this->reviewRepository->store($data);
    }

    public function update($id, $data){
        $review = $this->reviewRepository->update($id,$data);
        return $review;

    }

    public function delete(int $id){
        $review = $this->details($id);
        $product = $review->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->reviewRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->reviewRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->reviewRepository->findProducts($id);
    }

}