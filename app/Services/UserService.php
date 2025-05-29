<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ProductServices;

class UserService

{
    private UserRepository $userRepository;
    private ProductService $productService;

    public function __construct(UserRepository $userRepository, ProductService $productService){
        $this->userRepository = $userRepository;
        $this->productService = $productService;
    }

    public function get(){
        $categories = $this->userRepository->get();
        return $categories;
    }

    public function details($id){
        return $this->userRepository->details($id);
    }

    public function store(array $data){
        return $this->userRepository->store($data);
    }

    public function update($id, $data){
        $user = $this->userRepository->update($id,$data);
        return $user;

    }

    public function delete(int $id){
        $user = $this->details($id);
        $product = $user->products;
        
        foreach($products as $product){
            $this->productService->delete($product->id);
        }
        return $this->userRepository->delete($id);
    }

    public function getWithProducts(){
        return $this->userRepository->getWithProducts();
    }

    public function findProducts(int $id){
        return $this->userRepository->findProducts($id);
    }

}