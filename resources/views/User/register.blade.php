@extends('layouts.app')

@section('title', 'Signup - ')
    
@section('content')
<section class="Form my-4 mx-5">
    <div class="container">
        <div class="row no-gutters" style="margin-top: 50px">
            <div class="col-lg-5">
                <img src="{{ asset('images/svg2.svg') }}" alt="" class="img-fluid"
                    style="width: 500px; height: 850px">
            </div>

            <div class="col-lg-7 px-5 pt-5">

                <h5 style="font-weight: bold;">Sign up Here</h5>
                <hr>
                <form action="{{ route('user.create') }}" method="POST" autocomplete="off">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="Firstname" placeholder="First Name" value="{{ old('Firstname') }}">
                            <span class="text-danger">@error('Firstname'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="Lastname" placeholder="Last Name" value="{{ old('Lastname') }}">
                            <span class="text-danger">@error('Lastname'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="HomeNo" placeholder="Home No." value="{{ old('HomeNo') }}">
                            <span class="text-danger">@error('HomeNo'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="Street" placeholder="Street No" value="{{ old('Street') }}">
                            <span class="text-danger">@error('Street'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="City" placeholder="City" value="{{ old('City') }}">
                            <span class="text-danger">@error('City'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="Province" placeholder="Province" value="{{ old('Province') }}">
                            <span class="text-danger">@error('Province'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" class="form-control  my-3 " name="Email" placeholder="Email Address" value="{{ old('Email') }}">
                            <span class="text-danger">@error('Email'){{ $message }}@enderror</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="text" class="form-control  my-3 " name="Mobile" placeholder="Mobile No" value="{{ old('Mobile') }}">
                            <span class="text-danger">@error('Mobile'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" class="form-control  my-3 " name="Password" placeholder="Password" value="{{ old('Password') }}">
                            <span class="text-danger">@error('Password'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    

                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" class="form-control my-3 " name="ConfirmPassword" placeholder="Confirm Password" value="{{ old('ConfirmPassword') }}">
                            <span class="text-danger">@error('ConfirmPassword'){{ $message }}@enderror</span>
                        </div>
                    </div>
                  

                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btn2 mt-3 mb-3">Sign Up</button>
                        </div>
                    </div>
                    <p class="new">One of Us?&nbsp;&nbsp;<a class="signup-link" href="{{ route('user.Login') }}">Log In Here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection