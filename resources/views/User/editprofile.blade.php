@extends('layouts.app')

@section('title', 'EditProfile - ')
    
@section('content')
    <div class="container pt-5">
        <h1 class="text mt-5">Edit Account</h1>
    </div><br><br>


    <div class="container" data-aos="fade-down">
        <div class="row no-gutters">
            <div class="col-lg-5">
                <img src="{{ asset('images/profile.svg') }}" class="img-fluid prof" alt="" style="width: 500px; height: 500px;">
            </div>
            <form action="{{ route('user.UpdateProfile',Auth::user()->id) }}" method="POST" autocomplete="off">
                @csrf
                @if (Session::get('successUpdate'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('successUpdate') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (Session::get('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                <div class="col-md-6 ">
                    <h6 style="color: rgba(153, 158, 161, 0.877)">Personal info</h6><hr>
                    <h6 >First Name</h6>
                        <input type="text" class="form-control my-3 account" name="Firstname"  value="{{ old('Firstname',Auth::user()->firstname) }}" style="font-weight: bold">
                        <span class="text-danger">@error('Firstname'){{ $message }}@enderror</span>
                    <h6>Last Name</h6>
                        <input type="text" class="form-control  my-3 account" name="Lastname"  value="{{ old('Lastname',Auth::user()->lastname) }}" style="font-weight: bold">
                        <span class="text-danger">@error('Lastname'){{ $message }}@enderror</span>
                    </span><br>
                    
                    <h6 style="color: rgba(153, 158, 161, 0.877)">Contact info</h6><hr>
                    <h6>Email-Address</h6><input type="email" class="form-control my-3 account" name="Email"  value="{{ old('Email',Auth::user()->email) }}" style="font-weight: bold">
                    <span class="text-danger">@error('Email'){{ $message }}@enderror</span>

                    <h6>Mobile No</h6><input type="text" class="form-control my-3 account" name="Mobile"  value="{{ old('Mobile',Auth::user()->mobile) }}" style="font-weight: bold">
                    <span class="text-danger">@error('Mobile'){{ $message }}@enderror</span>
                </div><br>

                <div class="col-md-6">
                    <h6 style="color: rgba(153, 158, 161, 0.877)">Address info</h6><hr>
                    <h6>Home No.</h6><input type="text" class="form-control account my-3"  aria-label="home" name="HomeNo" value="{{ old('HomeNo',Auth::user()->home) }}" style="font-weight: bold">
                    <span class="text-danger">@error('HomeNo'){{ $message }}@enderror</span>

                    <h6>Street</h6><input type="text" class="form-control account my-3"  aria-label="Server" name="Street" value="{{ old('Street',Auth::user()->street) }}" style="font-weight: bold">
                    <span class="text-danger">@error('Street'){{ $message }}@enderror</span>

                    <h6>City</h6><input type="text" class="form-control  my-3 account" name="City"  value="{{ old('City',Auth::user()->city) }}" style="font-weight: bold">
                    <span class="text-danger">@error('City'){{ $message }}@enderror</span>

                    <h6>Province</h6><input type="text" class="form-control  my-3 account" name="Province"  value="{{ old('Province',Auth::user()->province) }}" style="font-weight: bold">
                    <span class="text-danger">@error('Province'){{ $message }}@enderror</span>
                </div>
                <div class="container">
                    <button type="submit" class="btn  edit-button" style="border-radius: 5px">Save</button>
                </div><br>                
            </form>
           
        </div>
    </div>




@endsection