<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
// use App\Models\ProductsOrder;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //
    public function makeOrder(OrderRequest $request){

        // $cartData = $request->input('cart');

        DB::beginTransaction();

        try {
           
            $order = Order::create();
    
           
            $productsData = [];
            foreach ($request->cart as $item) {
                $productsData[$item['id']] = ['quantity' => $item['quantity']];
            }
    
    
            $order->products()->attach($productsData);
    
            DB::commit();
    
            return response()->json([
                'success'=>true,
                'message' => 'Заказ успешно создан',
                'order_id' => $order->id,
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success'=>false,
                'message' => 'Ошибка при создании заказа',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
