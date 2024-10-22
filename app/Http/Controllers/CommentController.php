<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    //
    public function comment(Request $request){
        if($request->comment!== ''){
            Comment::create([
                'product_id'=> $request->product_id,
                'user_id'=> $request->user_id,
                'message'=> $request->comment,
            ]);
            Alert::success('Comment Form', 'has been submitted successfully');
        }
        return back();
    }

    //delete comment
    public function deleteComment($id){
        Comment::find($id)->delete();
        Alert::success('Delete Comment', 'has been deleted successfully');
        return back();
    }
}
