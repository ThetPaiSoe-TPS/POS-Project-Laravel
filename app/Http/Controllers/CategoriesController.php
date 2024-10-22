<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    //category list page
    public function list(){
        $categories= Categories::orderBy('created_at', 'desc')->paginate(3);
        return view('admin.category.list', compact('categories'));
    }

    //category create page
    public function create(Request $request){
        $this->checkValidation($request);
        Categories::create([
            'name'=> $request->categoryName,
            'created_at'=> Carbon::now(),
        ]);
        Alert::success('New Category', 'has been created successfully');
        return back();
    }

    //category delete page
    public function delete($id){
        Categories::find($id)->delete();
        Alert::success('Category', 'Deleted successfully');
        return back();
    }

    //category update page
    public function updatePage($id){
        $category= categories::where('id', $id)->first();
        return view('admin.category.update', compact('category'));
    }

    public function update($id, Request $request){
        $this->checkValidation($request);
        // $data= [
        //     'name'=> $request->name,
        //     'created_at'=> Carbon::now(),
        // ];
        // categories::where('id', $id)->update($data);

        //without using $data array
        Categories::where('id', $id)->update([
            'name'=> $request->categoryName,
            'created_at'=> Carbon::now(),
        ]);

        Alert::success('Category', 'Updated successfully');

        return to_route('category#list');
    }

    //check category validation
    private function checkValidation($request){
        $request->validate([
            'categoryName'=> 'required',
        ],[
            'categoryName.required'=> 'အမျိုးအစား လိုအပ်သည်။'
        ]);
    }
}
