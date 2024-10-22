<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //redirect change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        /*
            1. input password must be validate
            2. new password== confirm password
            3. old password == current login account password
            4. password change
        */

        $currentLoginPassword= auth()->user()->password;
        if(Hash::check($request->oldPassword, $currentLoginPassword)){
            User::where('id', auth()->user()->id)->update([
                'password'=> Hash::make($request->newPassword),
            ]);
            Alert::success('New Password', 'New Password had changed successfully');
            // return to_route('adminHome');

            //after changed password=> logout
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        }
        else{
            Alert::error('Error Password', 'Old password does not match with Current password');
            return back();
        }
    }

    //redirect account profile page
    public function accountProfilePage(){
        return view('admin.profile.accountProfile');
    }

    //redirect edit profile page
    public function editProfile(){
        return view('admin.profile.edit');
    }

    //update profile
    public function updateProfile(Request $request){
        $this->profileValidationCheck($request);

        $data= $this->requestProfileData($request);

        //check image is selected or not
        if($request->hasFile('image')){
            //delete old image
            if(Auth::user()->profile !== null){
                if(file_exists(public_path('profile/'.Auth::user()->profile))){
                    unlink(public_path('profile/'.Auth::user()->profile));
                }
            }

            //store new image
            $fileName= uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profile/',$fileName);
            $data['profile']= $fileName;
        }
        else{$data['profile']= Auth::user()->profile;}

        User::where('id', Auth::user()->id)->update($data);//update to DB

        Alert::success('New Update', 'Profile Updated successfully');//alert message from sweetalert

        return to_route(Auth::user()->role== 'superadmin' || Auth::user()->role== 'admin' ? 'profile#accountProfile#page': 'profile#edit');
    }

    //create new admin account
    public function createNewAdminAccount(){
        return view('admin.adminAccount.create');
    }

    //create admin account
    public function createAdminAccount(Request $request){
        $this->checkAdminValidation($request);
        $data= $this->requestAdminData($request);
        User::create($data);

        Alert::success('New Admin Account', 'Admin Account had created successfully');//alert message from sweetalert
        return to_route('profile#accountProfile#page');
    }

    //request data from new admin account
    public function requestAdminData($request){
        return [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'role'=> 'admin'
        ];
    }

    //admin list
    public function adminList(){
        // $admins= User::select('id', 'name', 'email', 'phone', 'provider', 'role', 'address', 'created_at', 'nickname')->orWhere('role', 'superadmin')->orWhere('role', 'admin')->paginate(4);

        // $admins= User::select('id', 'name', 'email', 'phone', 'provider', 'role', 'address', 'created_at', 'nickname')->paginate(4);

        // $admins= User::select('id', 'name', 'email', 'phone', 'provider', 'role', 'address', 'created_at', 'nickname')
        //         ->whereIn('role', ['admin', 'superadmin'])
        //         ->where('name', 'like', '%'.request('search').'%')
        //         ->paginate(2);

        $admins= User::whereIn('role', ['admin', 'superadmin'])
            ->when(request('search'), function($q){
            $q->whereAny(['name', 'email', 'address', 'phone', 'nickname'], 'like', '%'.request('search').'%');
        })
            ->select('id', 'name', 'email', 'phone', 'provider', 'role', 'address', 'created_at', 'nickname')->paginate(4);

        return view('admin.profile.list', compact('admins'));
    }

    //user list
    public function userList(){
        $users= User::where('role', ['user'])
        ->when(request('search'), function($query){
            $query->whereAny(['name', 'email', 'address', 'phone', 'nickname'], 'like', '%'.request('search').'%');
        })
        ->select('id', 'name', 'email', 'phone', 'provider', 'role', 'address', 'created_at', 'nickname')->paginate(4);
        return view('admin.profile.userList', compact('users'));
    }

    //user delete
    public function userDelete($id){
        User::where('id', $id)->delete();
        Alert::success('User List Account', 'User Account had been deleted successfully');//alert message from sweetalert
        return back();
    }

    //admin list delete
    public function delete($id){
        User::where('id', $id)->delete();
        Alert::success('Admin List Account', 'Admin Account had been deleted successfully');//alert message from sweetalert
        return back();
    }





    //check new admin account validation
    private function checkAdminValidation($request){
        $request->validate([
            'name'=> 'required|min:3|max:30',
            'email'=> 'required|unique:users,email,'.Auth::user()->id,
            'password'=> 'required|min:6',
            'confirmPassword'=> 'required|same:password|min:6'
        ]);
    }

    //password validation check
    private function passwordValidationCheck($request){
        $request->validate([
            'oldPassword'=> 'required',
            'newPassword'=> 'required|min:6',
            'confirmPassword'=> 'required|same:newPassword|min:6'
        ]);
    }

    //request profile data
    private function requestProfileData($request){
        return[
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
        ];
    }

    //update profile validation check
    private function profileValidationCheck($request){
        $request->validate([
            // 'name'=> 'required',
            'email'=> 'unique:users,email,'.Auth::user()->id, //cannot equal with user's table email// Auth()::user()->id means it can be equal it's user's table id(it means it can not be equal except it's email)
            'phone'=> 'min:8|numeric|unique:users,phone,'.Auth::user()->id, //cannot be equal with user's table phone
            'address'=> 'required',
            'image'=> 'mimes:png,jpg,jpeg,svg,webp|file'
        ]);
    }
}
