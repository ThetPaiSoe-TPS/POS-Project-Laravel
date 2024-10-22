<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //user rating
    public function rating(Request $request){
        Rating::updateOrCreate([
            'product_id'=> $request->product_id,
            'user_id'=> $request->user_id,
        ],
        [
            'product_id'=> $request->product_id,
            'user_id'=> $request->user_id,
            'count'=> $request->rating,
        ]);
        return back();
    }

}
