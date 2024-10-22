<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class AdminController extends Controller
{
    //
    public function adminHome(){
        //total sold amount
        $total_amt= PaymentHistory::sum('total_amt');
        $total_amt= (int)($total_amt);

        //order request
        $order_pending= Order::where('status', 0)->count();
        $order_complete= Order::where('status', 1)->count();
        $order_reject= Order::where('status', 2)->count();

        //registred account
        $superadmin_acc= User::where('role', 'superadmin')->count();
        $admin_acc= User::where('role', 'admin')->count();
        $user_acc= User::where('role', 'user')->count();

        return view('admin.home.list', compact('total_amt', 'order_pending', 'order_complete', 'order_reject', 'superadmin_acc', 'admin_acc', 'user_acc'));
        // dd('admin home');
    }

}
