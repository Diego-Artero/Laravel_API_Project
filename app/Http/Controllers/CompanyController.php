<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CompanyResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function get()
    {
        $companies = $this->companyService->get();
        return CompanyResource::collection($companies);

    }

    public function details(int $id)
    {
        try{
            $company = $this->companyService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Company not found', 404]);
        }
        return new CompanyResource($company);
    }

    public function store(CompanyStoreRequest $request)
    {
        $data = $request->all();
        $company = $this->companyService->store($data);

        return new CompanyResource($company);
    }
    public function update(int $id, CompanyUpdateRequest $request)
    {
        $data = $request->all();
        try{
            $company = $this->companyService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Company not found', 404]);
        }

        return new CompanyResource($company);

    }

    public function delete(int $id)
    {
        try{
            $company = $this->companyService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Company not found', 404]);
        }
        return new CompanyResource($company);
    }

    public function getWithProducts()
    {
        $companies = $this->companyService->getWithProducts();
        return CompanyResource::collection($companies);

    }

    public function findProducts(int $id)
    {
        try{
            $products = $this->companyService->findProducts($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Company not found', 404]);
        }
        return ProductResource::collection($products);
    }
}