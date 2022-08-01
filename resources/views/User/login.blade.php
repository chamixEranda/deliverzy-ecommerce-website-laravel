@extends('layouts.app')

@section('title', 'Login - ')
    
@section('content')
<section class="Form my-4 mx-5 mt-5" style="height: 80vh">
    <div class="container">
        <div class="row no-gutters" style="margin-top: 100px">
            <div class="col-lg-5">
                <img src="{{ asset('images/svg1.svg') }}" alt="" class="img-fluid" style="width: 500px; height: 400px">
            </div>

            <div class="col-lg-7 px-5 pt-5" >
               
                <h5 style="font-weight: bold;">Sign In to Your Account</h5>
                <hr>
                <form action="{{ route('user.check') }}" method="POST" autocomplete="off">
                    @if (Session::get('fail'))
                    <div class="alert alert-danger"> 
                        {{ Session::get('fail') }}
                    </div>
                @endif 
                    @csrf
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="email" class="form-control my-3 " name="email" placeholder="example@gmail.com" value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <input type="password" class="form-control mb-2" name="password" placeholder="******" value="{{ old('password') }}">
                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <button type="submit" class="btn1 mt-3 mb-2">Log In</button>
                        </div>
                    </div>
                    <a class="forgot" href="{{ route('password.request') }}">Forgot Password?</a><br><br>
                    <p class="new1">New to Deliverzy?&nbsp;&nbsp;<a class="signup-link" href="{{ route('user.Signup') }}">Sign Up Here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection