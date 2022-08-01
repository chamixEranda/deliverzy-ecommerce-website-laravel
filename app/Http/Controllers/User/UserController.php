<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function create(Request $request){
        $request->validate([
            'Firstname' => 'required',
            'Lastname' => 'required',
            'HomeNo' => 'required',
            'Street' => 'required', 
            'City' => 'required',
            'Province' => 'required',
            'Email' => 'required|email|unique:users,email',
            'Mobile' => 'required|numeric|digits:10',
            'Password' => 'required|min:8|max:20',
            'ConfirmPassword' => 'required|min:5|max:20|same:Password'
        ]);

        $id=DB::table('users')->max('id');
        $next_id= $id + 1;
       

        $user = new User();
        $user->id = $next_id;
        $user->firstname = $request->Firstname;
        $user->lastname = $request->Lastname;
        $user->home = $request->HomeNo;
        $user->street = $request->Street;
        $user->city = $request->City;
        $user->province = $request->Province;
        $user->email = $request->Email;
        $user->mobile = $request->Mobile;
        $user->password = \Hash::make($request->Password);
        $save = $user->save();

        $wishlist = new Wishlist();
        $wishlist->user_id = $next_id;
        $wishlist->save(); 

        $cart = new Cart();
        $cart->user_id = $next_id;
        $cart->save();

        if ($save) {
            return redirect()->back()->with('success','You are registered successfully');
        }else {
            return redirect()->back()->with('fail','Something went wrong, Failed to register');
        }
    }

    function check(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:20'
        ],[
            'email.exists' => 'This email is not exists'
        ]);
     
        $creds = $request->only('email','password');
        if (Auth::guard('web')->attempt($creds) ) {
            return redirect()->route('user.Home');
        }
        else {
            return redirect()->route('user.Login')->with('fail','Incorrect Email or Password');
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('user.Login');
    }

    function updateProfile(Request $request, $id){
        $request->validate([
            'Firstname' => 'required',
            'Lastname' => 'required',
            'HomeNo' => 'required',
            'Street' => 'required',
            'City' => 'required',
            'Province' => 'required',
            'Email' => 'required|email|unique:users,email,'.$id,
            'Mobile' => 'required|numeric|digits:10',
        ]);

        $update = User::where('id',$id)
            ->update([
                'firstname' => $request->input('Firstname'),
                'lastname' => $request->input('Lastname'),
                'home' => $request->input('HomeNo'),
                'street' => $request->input('Street'),
                'city' => $request->input('City'),
                'province' => $request->input('Province'),
                'email' => $request->input('Email'),
                'mobile' => $request->input('Mobile')
            ]);

            if ($update) {
                return redirect()->back()->with('successUpdate','Details update successfully.');
            }
            else {
                return redirect()->back()->with('fail', 'Something went wrong, failed to update details');
            }
    }
}
