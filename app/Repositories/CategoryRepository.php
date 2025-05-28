<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function get(){
        return Category::all();
    }

    public function details(int $id){
        return Category::findOrFail($id);
    }

    public function store(array $data){
        return Category::create($data);
    }

    public function update(int $id, array $data){
        $category = $this->details($id);
        $category->update($data);
        return $category;
    }

    public function delete(int $id){
        $category = $this->details($id);
        $category->delete();
        return $category;
    }
    
    public function getWithProducts(){
        $categories = Category::with('products')->get();
        return $categories;
    }

    public function findProducts(int $id){
        $category = $this->details($id);
        return $category->products;
    }
}