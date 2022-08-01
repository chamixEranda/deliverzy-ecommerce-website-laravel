@extends('layouts.app')

@section('title', 'Home - ')
    
@section('content')
<style>
    .topPick-card{
        transition: transform 250ms;
    }
    .topPick-card:hover{
        transform: translateY(-5px);
    }
</style>
<main>
    <div id="carouselExampleSlidesOnly" class="carousel slide mt-5" data-bs-ride="carousel" data-aos="fade-down">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/index slider.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/index slider2.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/index slider3.png') }}" class="d-block w-100"  alt="...">
            </div>
        </div>
    
    </div><br>
    
    
    <div class="container" data-aos="fade-down">
        <div class="row">
    
            <div class="col-md-6" >
    
                <img src="{{ asset('images/img1.png') }}" width="550px" height="250px" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);border-radius:5px">
            </div>
    
    
            <div class="col-md-6" >
    
                <img src="{{ asset('images/img2.png') }}" width="550" height="250px" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);border-radius:5px">
            </div>
        </div>
    </div><br>
    
    
    
    
    <!-- hedding and hr line -->
    
    <div class="container-fluid">
    
        <div class="row">
    
            <div class="col-md-5">
    
                <hr>
                
            </div>
    
            <div class="col-md-2">
    
                <h3 class="index-text text-center">Top Picks</h3>
            </div>
    
            <div class="col-md-5">
                <hr>
                
    
            </div>
        </div>
    </div>
    
    
    <!-- card -->
    
    
    <div class="container-fluid mb-5 " style="padding-left: 80px;">
        
        {{-- <div class="row">
            @foreach ($top as $item)
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('productImages/'.$item->imagepath) }}" class="card-img-top" height="130px">
    
                    
                    <div class="card-body">
                        <h6 class="card-title">{{ $item->name }}</h6>
                        <p class="card-text">Rs.{{ $item->price }}.00/kg</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>
                   
    
                </div>
    
            </div>
            @endforeach
    
        </div> --}}
        
    </div>
    
    
    
    <!-- hedding and hr line -->
    
    <div class="container-fluid">
    
        <div class="row">
    
            <div class="col-md-5">
    
                <hr>
                </hr>
            </div>
    
            <div class="col-md-2">
    
                <h3 class="index-text text-center">Best Sellers</h3>
            </div>
    
            <div class="col-md-5">
                <hr>
                </hr>
    
            </div>
        </div>
    </div>
    
    
    <!-- second card -->
    
    <div class="container-fluid mb-5 " style="padding-left: 80px;" data-aos="fade-right">
        <div class="row">
    
    
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('images/Maliban Chick Bits.png') }}" class="card-img-top"
                        height="110px">
    
                    
                    <div class="card-body">
                        <h6 class="card-title">Maliban Chick Bits</h6>
                        <p class="card-text">Rs.270.00/kg</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
    
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('images/Linna.png') }}" class="card-img-top" height="130px">
    
                    
                    <div class="card-body">
                        <h6 class="card-title">Linna</h6>
                        <p class="card-text">Rs.590.00/Unit</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill" style="margin-top: 20px;"></i></a>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
    
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('images/Wonder.png') }}" class="card-img-top" height="110px"
                        onclick="popup">
    
                    <div class="card-body">
                        <h6 class="card-title">Wonder Cone
                            Chocolate</h6>
                        <p class="card-text">Rs.70.00/kg</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
    
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('images/Ramba Tetos Bbq 20g.png') }}" class="card-img-top"
                        height="110px">
    
                    
                    <div class="card-body">
                        <h6 class="card-title">Ramba Tetos Bbq 20g</h6>
                        <p class="card-text">Rs.40.00/Unit</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill"></i></a>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
    
            <div class="col-md-2 mt-4 ms-4 ">
    
                <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
                    <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
                    <img src="{{ asset('images/Banana Ambul.png') }}" class="card-img-top" height="130px">
    
                   
                    <div class="card-body">
                        <h6 class="card-title">Banana Ambul</h6>
                        <p class="card-text">Rs.100.00/Unit</p>
    
                        <div class="cart ">
                            <a href="#"><i class="bi bi-cart-plus-fill" style="margin-top: 19px;"></i></a>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
    
    
    
    
    
    
        </div>
    </div>
    
    <!--down banners -->
    <div class="container-fluid" data-aos="flip-up">
        <div class="row">
    
            <div class="col-md-12 ">
    
                <img src="{{ asset('images/img3.png') }}" class="w-100" height="400px" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);border-radius:5px">
            </div>
        </div>
    
    
    </div><br><br>
</main>
@endsection
