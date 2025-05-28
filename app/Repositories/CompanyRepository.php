<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function get(){
        return Company::all();
    }

    public function details(int $id){
        return Company::findOrFail($id);
    }

    public function store(array $data){
        return Company::create($data);
    }

    public function update(int $id, array $data){
        $company = $this->details($id);
        $company->update($data);
        return $company;
    }

    public function delete(int $id){
        $company = $this->details($id);
        $company->delete();
        return $company;
    }
    
    public function getWithProducts(){
        $companies = Company::with('products')->get();
        return $companies;
    }

    public function findProducts(int $id){
        $company = $this->details($id);
        return $company->products;
    }
}