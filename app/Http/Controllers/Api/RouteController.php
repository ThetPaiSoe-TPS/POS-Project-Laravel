<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Comment;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    //
    public function comment(){
        $comment= Comment::get();
        return response()->json($comment, 200);
    }

    public function category(){
        $category= Categories::get();
        return response()->json($category, 200);
    }

    public function createCategory(Request $request){
        $data= [
            'name'=> $request->name,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];

        $response= Categories::create($data);

        return response()->json($response, 200);
    }

    //create contact
    public function createContact(Request $request){
        $data= $this->contactData($request);

        Contact::create($data);
        $contact= Contact::orderBy('created_at', 'desc')->get();
        return response()->json($contact, 200);
    }

    private function contactData($request){
        return $data= [
            "user_id"=> $request->user_id,
            "title"=> $request->title,
            "message"=> $request->message,
            "created_at"=> Carbon::now(),
            "updated_at"=> Carbon::now(),
        ];
    }

    //delete category with post method
    public function deleteCategory(Request $request){
        $data= Categories::where('id', $request->category_id)->first();
        if(isset($data)){
            Categories::where('id', $request->category_id)->delete();
            return response()->json(['status'=> true, 'message'=> 'deleted successfully'], 200);
        }
        return response()->json([ 'status'=>false, 'message'=> 'There is no category id in Database'], 200);
    }

    //delete category with get method
    public function deleteCategoryWithGet($id){
        $data= Categories::find($id);
        if(isset($data)){
            Categories::find($id)->delete();
            return response()->json(['status'=> true, 'message'=> 'deleted successfully'], 200);
        }
        return response()->json([ 'status'=>false, 'message'=> 'There is no category id in Database'], 200);
    }
}
