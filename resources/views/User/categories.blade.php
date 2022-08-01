@extends('layouts.app')

@section('title', 'Categories - ')
    
@section('content')
    
    <div class="container container-box" data-aos="fade-up">

        <div class="box"
            style="background-image : url({{ asset('images/Beverages.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Beverages') }}'">
           
            <p class="box-text">Beverages</p>
        </div>

        <div class="box"
            style="background-image : url({{ asset('images/Dry\ Rations.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-DryRations') }}'">
        
            <p class="box-text">Dry Rations</p>
        </div>

        <div class=" box"
            style="background-image : url({{ asset('images/Fruit.jpg') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Fruits') }}'">
    
            <p class="box-text">Fruits</p>
        </div>

        <div class=" box"
            style="background-image : url({{ asset('images/MeatFish.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Meat&SeaFood') }}'">
        
            <p class="box-text">Meat & Sea food</p>
        </div>

        <div class=" box"
            style="background-image : url({{ asset('images/Vegetables.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-vegetables') }}'">
          
            <p class="box-text">Vegetables</p>
        </div>

     


    </div>

    <div class="container-fluid" data-aos="fade-up">
        <div class="row">
            <div class="col-md-6">
                <div class="box1"
                    style="background-image : url({{ asset('images/Chilled.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Chilled') }}'">

                    <p class="box-text1">Chilled</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box1"
                    style="background-image : url({{ asset('images/Grocery.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Grocery') }}'">

                    <p class="box-text1">Grocery</p>
                </div>

            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="box1"
                   style="background-image : url({{ asset('images/Backery.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Backery') }}'">

                    <p class="box-text1">Backery</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box1"
                    style="background-image : url({{ asset('images/Others.png') }}); background-position: 50% 50%; object-fit: cover;" onclick="location.href='{{ route('Categories-Others') }}'">

                    <p class="box-text1">Others</p>
                </div>

            </div>

        </div>
    </div>

@endsection