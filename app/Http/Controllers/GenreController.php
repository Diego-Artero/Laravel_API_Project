<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\GenreService;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class GenreController extends Controller
{
    private GenreService $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function get()
    {
        $genres = $this->genreService->get();
        return GenreResource::collection($genres);

    }

    public function details(int $id)
    {
        try{
            $genre = $this->genreService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return new GenreResource($genre);
    }

    public function store(GenreStoreRequest $request)
    {
        $data = $request->all();
        $genre = $this->GenreService->store($data);

        return new GenreResource($genre);
    }
    public function update(int $id, GenreUpdateRequest $request)
    {
        $data = $request->all();
        try{
            $genre = $this->GenreService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }

        return new GenreResource($genre);

    }

    public function delete(int $id)
    {
        try{
            $genre = $this->GenreService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return new GenreResource($genre);
    }

    public function getWithBooks()
    {
        $genres = $this->genreService->getWithBooks();
        return GenreResource::collection($genres);

    }

    public function findBooks(int $id)
    {
        try{
            $products = $this->genreService->findBooks($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return BookResource::collection($products);
    }
}