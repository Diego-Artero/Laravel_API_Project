<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\ReviewService;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class ReviewController extends Controller
{
    private ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function get()
    {
        $reviews = $this->reviewService->get();
        return ReviewResource::collection($reviews);

    }

    public function details(int $id)
    {
        try{
            $review = $this->reviewService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review not found', 404]);
        }
        return new ReviewResource($review);
    }

    public function store(ReviewStoreRequest $request)
    {
        $data = $request->all();
        $review = $this->ReviewService->store($data);

        return new ReviewResource($review);
    }
    public function update(int $id, ReviewUpdateRequest $request)
    {
        $data = $request->all();
        try{
            $review = $this->reviewService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review not found', 404]);
        }

        return new ReviewResource($review);

    }

    public function delete(int $id)
    {
        try{
            $review = $this->reviewService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Review not found', 404]);
        }
        return new ReviewResource($review);
    }

   
    
}