<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;




class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get()
    {
        $users = $this->userService->get();
        return UserResource::collection($users);

    }

    public function details(int $id)
    {
        try{
            $user = $this->userService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return new UserResource($user);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->store($data);

        return new UserResource($user);
    }
    public function update(int $id, UserUpdateRequest $request)
    {
        $data = $request->all();
        try{
            $user = $this->userService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }

        return new UserResource($user);

    }

    public function delete(int $id)
    {
        try{
            $user = $this->userService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return new UserResource($user);
    }
    public function findReviews(int $id)
    {
        try{
            $reviews = $this->UserService->findReviews($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return ReviewResource::collection($reviews);
    }
}