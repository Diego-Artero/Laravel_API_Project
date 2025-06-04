<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ReviewServices;

class UserService

{
    private UserRepository $userRepository;
    private ReviewService $reviewService;

    public function __construct(UserRepository $userRepository, ReviewService $reviewService){
        $this->userRepository = $userRepository;
        $this->reviewService = $reviewService;
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
        $reviews = $user->reviews;
        
        foreach($reviews as $review){
            $this->reviewService->delete($review->id);
        }
        return $this->userRepository->delete($id);
    }

    public function findReviews(int $id){
        return $this->userRepository->findReviews($id);
    }

}