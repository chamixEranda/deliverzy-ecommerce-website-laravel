<?php

namespace App\Http\Controllers\DeliveryPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryPerson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliverPersonController extends Controller
{
    public function create() {
        $maxid = DB::table('delivery_people')->max('id')+1;
        return view('DeliverPerson.Register')->with('maxid',$maxid);

    }

    public function store(Request $request){
        $request->validate([
            'Firstname' => 'required',
            'Lastname' => 'required',
            'Email' => 'required|email|unique:delivery_people,email',
            'Password' => 'required|min:5|max:20',
            'Confirmpassword' => 'required|min:5|max:20|same:Password'
        ]);

        
        $id=DB::table('delivery_people')->max('id');
        $next_id= $id + 1;
        
        $deliverperson = new DeliveryPerson();
        $deliverperson->id = $next_id;
        $deliverperson->first_name = $request->Firstname;
        $deliverperson->last_name = $request->Lastname;
        $deliverperson->email = $request->Email;
        $deliverperson->password = \Hash::make($request->Password);
        $save = $deliverperson->save();

        if( $save ) {
            return redirect()->route('admin.DeliverPerson')->with('success','Registered A New Delivery Person');
        }
        else{
            return redirect()->back()->with('fail','Something Went Wrong');
        }
    }

    public function index(){
        $deliverperson = DeliveryPerson::get(); 
        return view('Admin.deliverPerson')->with('deliverperson',$deliverperson); 
    }

    public function check(Request $request){

        $request->validate([
            'email' => 'required|email|exists:delivery_people,email',
            'password' => 'required|min:5|max:20'
        ],[
            'email.exists' => 'This email is not exists'
        ]);

        $creds = $request->only('email' ,'password');
        // dd($creds);
        if (Auth::guard('delivery-person')->attempt($creds)) {
           return redirect()->route('delivery-person.DP-Home'); 
        }
        else{
            return redirect()->route('delivery-person.DP-Login')->with('fail', 'Incorrect Email or Password');
        }
    }

    public function destroy($id){
        
        $deliverperson = DeliveryPerson::find($id)->delete();
        return redirect()->route('admin.DeliverPerson')->with('successDelete','DeliverPerson ID '.$id.' deleted successfully');
    }

    public function show(){
        $deliverperson = DeliveryPerson::with('deliveries','orders');
    }

}
