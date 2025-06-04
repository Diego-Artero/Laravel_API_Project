<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function get()
    {
        $Books = $this->bookService->get();
        return BookResource::collection($Books);
    }

    public function details($id){
        try{
            $Book = $this->bookService->details($id);

        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return new BookResource($Book);
    }

    public function store(BookStoreRequest $request){
        $data = $request->validated();
        $Book = $this->bookService->store($data);
        return new BookResource($Book);
    }

    public function update(int $id, BookUpdateRequest $request){
        $data = $request->validated();
        try{
            $Book = $this->bookService->update($id, $data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return new BookResource($Book);
    }

    public function delete(int $id){
        try{
            $Book = $this->bookService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return new BookResource($Book);
    }

    public function getWithEverything(){
        $Books = $this->bookService->getWithEverything();
        return BookResource::collection($Books);
    }

    public function findReviews(int $id){
        try{
            $review = $this->bookService->findReviews($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return response()->json($review);
    }
}
