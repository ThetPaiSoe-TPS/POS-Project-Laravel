<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class OrderController extends Controller
{
    //order list
    public function list(){
        $orders= Order::select('users.id as user_id', 'users.name as user_name', 'orders.user_id', 'orders.status', 'orders.order_code', 'orders.created_at' )
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->when(request('search'), function($query){
                $query->whereAny(['users.name', 'orders.order_code'],'like', '%'.request('search').'%');
            })
            ->groupBy('orders.order_code')->orderBy('orders.created_at', 'desc')->get();
        return view('admin.order.list', compact('orders'));
    }

    //oreder details
    public function details($order_code){
        $order_codes= Order::select('orders.count', 'orders.order_code', 'orders.created_at', 'products.id as product_id', 'products.name as product_name', 'products.price', 'products.stock', 'products.image', 'users.name as user_name', 'users.nickname', 'users.phone', 'users.email', 'users.address')
            ->leftJoin('products', 'orders.product_id', 'products.id')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orders.order_code', $order_code)->get();
        $payment= PaymentHistory::where('order_code', $order_code)->first();
        $confirmStatus= [];
        $status= true;

        foreach($order_codes as $item){
            array_push($confirmStatus, $item->count > $item->stock? false: true);
        }

        foreach($confirmStatus as $item){
            if(!$item){
                $status= false;
                break;
            }
        }
        return view('admin.order.details', compact('order_codes', 'payment', 'status'));
    }

    //change status with ajax
    public function changeStatus(Request $request){
        Order::where('order_code', $request['order_code'])->update([
            'status'=> $request['status']
        ]);

        return response()->json([
            'status'=> 'succeeded'
        ], 200);
    }

    //order confirm
    public function confirmOrder(Request $request){
        //to change pending state to complete state
        Order::where('order_code', $request[0]['order_code'])->update([
            'status'=> 1
        ]);

        //substract stock - order_count
        foreach($request->all() as $item){
            Product::where('id', $item['product_id'])->decrement('stock', $item['product_count']);
        }

        return response()->json([
            'status'=> 'succeeded'
        ], 200);
    }

    //cancel order
    public function cancelOrder(Request $request){
        Order::where('order_code', $request->orderCode)->update(['status'=> 2]);

        return response()->json([
            'status'=> 'succeeded'
        ], 200);
    }

}
