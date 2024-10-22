<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Usercontroller extends Controller
{
    // 01=> 00 01 10 11
    //
    public function userHome($category_id= null){

    // public function userHome(){
        $categories= Categories::get();
        $cat_id= $category_id;

        $products= Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.stock', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            //search by key
            ->when(request('search'), function($query){
                $query->where('products.name', 'like', '%'.request('search').'%');
            })
            //search by category id with parameter
            ->when($category_id != null, function($q) use ($category_id){
                $q->where('products.category_id', $category_id);
            })
            // ->when(request('categoryId'), function($q) {
            //     $q->where('porducts.category_id', request('categoryId'));
            // })
            // min == true || max == true
            ->when(request('minPrice') != null && request('maxPrice')!= null, function($q){
                $q->whereBetween('products.price', [request('minPrice'), request('maxPrice')]);
            })
            // min== true || max== false
            ->when(request('minPrice')!= null && request('maxPrice')== null, function($query){
                $query->where('products.price', ">=", request('minPrice'));
            })
            // min== false || max== true
            ->when(request('minPrice')== null && request('maxPrice')!= null, function($q){
                $q->where('products.price', "<=", request('maxPrice'));
            })
            //sorting option
            ->when(request('sorting'), function($q){
                $str_arr= explode(',', request('sorting'));
                $sortName= 'products.'.$str_arr[0];
                $sortType= $str_arr[1];
                $q->orderBy($sortName, $sortType);
            })
            // ->orderBy('products.created_at', 'desc')
            ->get();
        // return view('user.home.list', compact('products', 'categories'));
        return view('user.home.list', compact('products', 'categories', 'cat_id'));
    }

    //edit profile
    public function editProfile(){
        return view('user.profile.edit');
    }

    //change password
    public function changePassword(){
        return view('user.profile.changePassword');
    }


}
