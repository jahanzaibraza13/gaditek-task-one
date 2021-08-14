<?php


namespace App\Http\Services;



use App\Models\UserService;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    /**
     * @param $service
     */
   public function createUserService($service)
   {
       $userService = new UserService();

       $userService->user_id = Auth::id();
       $userService->service_id = $service->id;
       $userService->price = $service->price;
       $userService->status = "Pending";

       $userService->save();
   }
}
