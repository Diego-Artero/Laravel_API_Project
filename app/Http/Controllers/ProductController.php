<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    private ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function get()
    {
        $products = $this->productService->get();
        return ProductResource::collection($products);
    }

    public function details($id){
        try{
            $product = $this->productService->details($id);

        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'product not found'],404);
        }
        return new ProductResource($product);
    }

    public function store(ProductStoreRequest $request){
        $data = $request->validated();
        $product = $this->productService->store($data);
        return new ProductResource($product);
    }

    public function update(int $id, ProductUpdateRequest $request){
        $data = $request->validated();
        try{
            $product = $this->productService->update($id, $data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'product not found'],404);
        }
        return new ProductResource($product);
    }

    public function delete(int $id){
        try{
            $product = $this->productService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'product not found'],404);
        }
        return new ProductResource($product);
    }

    public function getWithCategory(){
        $products = $this->productService->getWithCategory();
        return ProductResource::collection($products);
    }

    public function findCategory(int $id){
        try{
            $category = $this->productService->findCategory($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'product not found'],404);
        }
        return response()->json($category);
    }
}
