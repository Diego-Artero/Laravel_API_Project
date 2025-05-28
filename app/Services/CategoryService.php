<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\ProductServices;

class CategoryService

{
    private CategoryRepository $categoryRepository;
    private ProductService $productService;

    public function __construct(CategoryRepository $categoryRepository, ProductService $productService){
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
    }

    public function get(){
        $categories = $this->categoryRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->categoryRepository->details($id);
    }

    public function store(array $data){
        return $this->categoryRepository->store($data);
    }

    public function update($id, $data){
        $category = $this->categoryRepository->update($id,$data);
        return $category;

    }

    public function delete(int $id){
        $category = $this->details($id);
        $products = $category->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->categoryRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->categoryRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->categoryRepository->findProducts($id);
    }

}