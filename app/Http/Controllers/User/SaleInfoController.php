<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleInfoController extends Controller
{
    //
    public function saleInfo(){
        $orderList= Order::select('orders.count as order_count', 'orders.status', 'orders.order_code', 'orders.created_at', 'products.name', 'products.price', 'products.stock', 'products.image', 'users.name as user_name',   )
            ->groupBy('order_code')
            ->leftJoin('products', 'orders.product_id', 'products.id')
            ->leftJoin('users', 'orders.user_id', 'users.id' )
            ->paginate(3);
        return view('admin.home.saleInfo', compact('orderList'));
    }
}
