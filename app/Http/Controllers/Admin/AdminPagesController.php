<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function productPage(){
        return view('Admin.products');
    }
    public function AddproductPage(){
        return view('Admin.addProducts');
    }
    public function EditproductPage(){
        return view('Admin.editProducts');
    }
}
