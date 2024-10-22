<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //details page
    public function details($id){
        $this->actionLog(Auth::user()->id, $id, 'view details');
        $product= Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.stock', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)// id only cannot write ->where('id', $id) will cause error
            ->first();
        $products= Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.stock', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('categories.name', $product['category_name'])
            ->get();

        $comment= Comment::select('users.profile', 'users.id as user_id', 'users.name', 'users.nickname', 'comments.id', 'comments.message', 'comments.created_at')
            ->leftJoin('users', 'comments.user_id', 'users.id')
            ->where('comments.product_id', $id)->orderBy('comments.created_at', 'desc')->get();

        $ratings= Rating::select('users.name', 'users.nickname', 'users.profile', 'ratings.count', 'ratings.created_at')
            ->leftJoin('users', 'ratings.user_id', 'users.id')
            ->where('ratings.product_id', $id)->get();

        $rate= Rating::where('product_id', $id)->avg('count');


        $count_rate= Rating::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

        $count= $count_rate== null? 0: $count_rate['count'];

        $action_log= ActionLog::where('post_id', $id)->where('action', 'view details')->get();

        return view('user.home.details', compact('product', 'products', 'comment', 'ratings', 'rate', 'count', 'action_log'));
    }

    //add to Cart
    public function addToCart(Request $request){
        $this->actionLog(Auth::user()->id, $request->productId, 'added to cart');
        Cart::create([
            'user_id'=> $request->userId,
            'product_id'=> $request->productId,
            'qty'=> $request->count,
        ]);
        Alert::success('Cart', 'Added to Cart successfully');//alert message from sweetalert
        return back();
    }

    //cart page
    public function cart($id){
        $this->actionLog(Auth::user()->id, $id, 'check cart');
        $cartList= Cart::select('products.id', 'products.image', 'products.name', 'products.price', 'carts.qty')
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->where('user_id', $id)
            ->get();
        $total= 0;
        foreach($cartList as $cart){
            $total+= $cart-> price* $cart-> qty;
        }
        return view('user.home.cart', compact('cartList', 'total'));
    }

    //product delete
    public function productDelete(Request $request){
        $cartId= $request->cartId;
        Cart::where('product_id', $cartId)->delete();

        return response()->json([
            'status'=> 'success',
            'message'=> 'cart deleted successfully',
        ], 200);
    }

    //product list for generate api
    // http://127.0.0.1:8000/user/product/list
    // public function productList(){
    //     $product= Product::get();
    //     return response()->json([
    //         'data'=> $product,
    //         'status'=> 'success'
    //     ], 200);
    // }

    //or use like this
    // public function productList(Request $request){
    //     $product= Product::get();
    //     return response()->json($product, 200);
    // }

    //temporary store
    public function temp(Request $request){
        $orderArr= [];
        foreach($request->all() as $item){
            array_push($orderArr, [
                'product_id'=> $item['product_id'],
                'user_id'=> $item['user_id'],
                'qty'=> $item['qty'],
                'order_code'=> $item['order_code'],
                'status'=> 0,
                'total_amount'=> $item['total_amount']
            ]);
        }
        Session::put('tempCart', $orderArr);// store in session

        return response()->json([
            'status'=> 'success'
        ], 200);
    }

    // user payment
    public function payment(){
        $payments= Payment::orderBy('type', 'asc')->get();
        $orderProduct= Session::get('tempCart');
        return view('user.home.payment', compact(['payments', 'orderProduct']));
    }

    //payment order
    public function paymentOrder(Request $request){

        $this->actionLog(Auth::user()->id, $request->productId, 'Payment order');
        $this->paymentValidation($request);

        $data = $this->paymentHistoryData($request);

        if($request->hasFile('paySlip')){
            $file= $request->file('paySlip');
            $fileName= uniqid().$file->getClientOriginalName();
            $file-> move(public_path().'/paymentSlip', $fileName);
            $data['payslip_image']= $fileName;
        }

        PaymentHistory::create($data);

        //oreder and clean cart data
        $orderProduct= Session::get('tempCart'); // get temporary session data

        //add looping session data to order table in DB
        foreach($orderProduct as $order){
            Order::create([
                'product_id'=> $order['product_id'],
                'user_id'=> $order['user_id'],
                'count'=> $order['qty'],
                'status'=> $order['status'],
                'order_code'=> $order['order_code'],
            ]);

            //delete data in cart
            Cart::where('product_id', $order['product_id'])->where('user_id', $order['user_id'])->delete();
        }

        Alert::success('Payment & Order', 'has proceeded successfully');//alert message from sweetalert
        return to_route('userHome');

    }

    //order list
    public function orderList(){
        $order= Order::where('user_id', Auth::user()->id)->groupBy('order_code')->orderBy('created_at', 'desc')->get();
        return view('user.home.orderList', compact('order'));
    }

    //create page
    public function create()
    {
        $categories = Categories::get();
        return view('admin.product.create', compact('categories'));
    }

    //create product
    public function createProduct(Request $request)
    {
        $this->actionLog(Auth::user()->id, $request->product_id, 'productCreated');
        $this->checkProductValidation($request, 'create');

        $file = $request->file('image');
        $product= $this->getProductData($request);
        if ($request->hasFile('image')) {
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move(public_path() . '/product/', $fileName);
            $product['image'] = $fileName;
        }
            Product::create($product);
            Alert::success('New Product', 'Created successfully');
            return back();
    }

    //product list
    public function productList($amt= 'default'){
        $products= Product::select('products.id', 'products.name', 'products.image', 'products.stock', 'products.price', 'products.description', 'products.category_id', 'categories.name as category_name')
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->when(request('search'), function($query){
            $query->whereAny(['products.name', 'categories.name'], 'like', '%'.request('search').'%');
        });
        if($amt != 'default'){
            $products= $products->where('stock',"<=",5);
        }
        $products= $products->orderBy('products.created_at', 'desc')->paginate(5);
        return view('admin.product.list', compact('products'));
    }

    //update page
    public function updatePage($id){
        $categories= Categories::get();
        $product= Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    //update
    public function update(Request $request){
        $this->actionLog(Auth::user()->id, $request->productId, 'update');
        $this->checkProductValidation($request, 'update');
        $product= $this->getProductData($request);

        if($request->hasFile('image')){
            if(file_exists(public_path('product/'.$request->oldImage))){
                unlink(public_path('product/'.$request->oldImage));
            }

            $fileName= uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/product/',$fileName);
            $product['image']= $fileName;
        }
        else{
            $product['image']= $request->oldImage;
        }

        Product::where('id', $request->productId)->update($product);
        Alert::success('Product Update', 'Product has been updated successfully');
        return to_route('product#list');
    }

    //view listPage
    public function listPage($id){
        $product= Product::where('id', $id)->first();
        return view('admin.product.view', compact('product'));
    }

    //delete
    public function delete($id){
        $this->actionLog(Auth::user()->id, $id, 'delet');
        Product::find($id)->delete();
        Alert::success('Product', 'has been Deleted successfully');
        return back();
    }





    //get product data
    public function getProductData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryName,
            'stock' => $request->stock,
        ];
    }

    //product validation
    public function checkProductValidation($request, $action)
    {
        $rules = [
            'name' => 'required|unique:products,name,'.$request->productId,
            'categoryName' => 'required',
            'stock' => 'required|numeric|max:100',
            'price' => 'required|numeric|min:3',
            'description' => 'required|max:1000',
        ];
        $rules['image']= $action== 'create'? 'required|mimes:png,jpeg,jpg,webp|file': 'mimes:png,jpeg,jpg,webp|file';
        $message = [];
        $request->validate($rules, $message);
    }









    //payment history data
    private function paymentHistoryData($request){
        return [
            'user_name'=> Auth::user()->name,
            'address'=> $request->address,
            'payment_method'=> $request->paymentMethod,
            'phone'=> $request->phone,
            'total_amt'=> $request->totalAmount,
            'order_code'=> $request->orderCode,
            'payslip_image'=> $request->paySlip,
        ];
    }

    //payment validation
    private function paymentValidation($request){
        $request->validate([
            'address'=> 'required',
            'paymentMethod'=> 'required',
            'paySlip'=> 'required',
            'phone'=> 'required',
        ]);
    }

    //action log function
    private function actionLog($userId, $productId, $action){
        ActionLog::create([
            'user_id'=> $userId,
            'post_id'=> $productId,
            'action'=> $action
        ]);
    }




}
