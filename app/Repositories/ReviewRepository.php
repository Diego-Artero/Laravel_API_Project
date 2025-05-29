<?php

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    public function get(){
        return Review::all();
    }

    public function details(int $id){
        return Review::findOrFail($id);
    }

    public function store(array $data){
        return Review::create($data);
    }

    public function update(int $id, array $data){
        $review = $this->details($id);
        $review->update($data);
        return $review;
    }

    public function delete(int $id){
        $review = $this->details($id);
        $review->delete();
        return $review;
    }
    
    public function getWithProducts(){
        $reviews = Review::with('products')->get();
        return $reviews;
    }

    public function findProducts(int $id){
        $review = $this->details($id);
        return $review->products;
    }
}