<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getSubscribeProducts(){
        return ProductResource::collection(Product::whereIn('categories_id', function ($query) {
            $query->select('id')
                ->from('categories')
                ->whereIn('name', ['milk', 'vegetables_and_fruits']);
        })->where('available',true)->get());
    }
    public function postProducts(ProductStoreRequest $request){
        $created_product = Product::create($request->validated());
        return new ProductResource($created_product);
    }
    public function postSubscribe(SubscriptionStoreRequest $request){
        //get user from middleware and check if he/she already subscribed
        $user = $request->user();
        if($user->subcriptions){
            return new Response(['error' => 'You already have subscribed'], 400);
        }
        $user->subscriptions = true;
        $user->update(); //update user as subscribed

        $created_subcsription = $request->validated(); //products from request
        //check if the products of the request in categories milk, vegetables_and_fruits
        // and check if the available
        $availableProducts = Product::whereIn('categories_id', function ($query) {
            $query->select('id')
                ->from('categories')
                ->whereIn('name', ['milk', 'vegetables_and_fruits']);
        })->where('available',true)->whereIn('id', $created_subcsription['products'])->get();

        // check if the all products from request in available products
        if ($availableProducts->count() != count($created_subcsription['products'])) {
            return new Response(['error' => 'Invalid request'], 400);
        }

        $created_subcsription['users_id'] = $user->id;
        $created_subcsription = Subscription::create($created_subcsription);
        return new SubscriptionResource($created_subcsription);

    }

}
