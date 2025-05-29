<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryController extends Controller
{
    private CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function get()
    {
        $categories = $this->categoryService->get();
        return CategoryResource::collection($categories);
    }

    public function details($id){
        try{
            $category = $this->categoryService->details($id);

        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Category not found', 404]);
        }
        return new CategoryResource($category);
    }

    public function store(CategoryStoreRequest $request){
        $data = $request->validated();
        $category = $this->categoryService->store($data);
        return new CategoryResource($category);
    }

    public function update(int $id, CategoryUpdateRequest $request){
        $data = $request->validated();
        try{
            $category = $this->categoryService->update($id, $data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Category not found', 404]);
        }
        return new CategoryResource($category);
    }

    public function delete(int $id){
        try{
            $category = $this->categoryService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Category not found', 404]);
        }
        return new CategoryResource($category);
    }

    public function getWithProducts(){
        $categories = $this->categoryService->getWithProducts();
        return CategoryResource::collection($categories);
    }

    public function findProducts(int $id){
        try{
            $product = $this->categoryService->findProducts($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Category not found', 404]);
        }
        return ProductResource::collection($products);
    }
}
