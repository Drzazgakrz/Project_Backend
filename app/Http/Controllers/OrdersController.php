<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\User;

class OrdersController extends Controller
{
    public function createOrder(Request $request)
    {
        try
        {
            $userId = User::where('email',$request['email'])->pluck('id')->first();
            $productId = Product::where('name', $request['productName'])->pluck('id')->first();
            if(Order::create(['user_id'=>$userId, 'product_id'=>$productId]))
            {
                return response()->json(['success'=>true],200);
            }
        }catch(\Exception $e)
        {
            return response()->json(['success'=>false],500);
        }
        return response()->json(['success'=>false],404);
    }
    public function delete(Request $request)
    {

        try{
            if(Order::where('id',$request['id'])->delete())
            {
                return response()->json(['success'=>true],200);
            }
            else
            {
                response()->json(['success'=>false],404);
            }
        }
        catch(\Exception $e)
        {
            return response()->json(['success'=>false],500);
        }
        return response()->json(['success'=>false], 419);
    }
    public function showOrders(Request $request)
    {
        $toResponse=[];
        try
        {
            $queryConditions = ['email'=>$request['email']];
            $userId=User::where($queryConditions)->pluck('id');
            $queryConditions = ['user_id'=>$userId[0]];
            $Order = Order::where($queryConditions)->pluck('product_id','id');
            foreach ($Order as $id=>$productId)
            {
                $queryConditions=['id'=>$productId];
                $toResponse[$id] = Product::where($queryConditions)->pluck('name');
            }
        }catch(\Exception $e)
        {
            return response()->json(['success'=>false],500);
        }
        if($Order->count())
       {
            return response()->json(['success'=>true,'data'=>$toResponse],200);
        }
        return response()->json(['success'=>false],404);
    }
}
