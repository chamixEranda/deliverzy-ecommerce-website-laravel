@extends('layouts.app')

@section('title', 'About - ')
    
@section('content')
<section data-aos="fade-down"
data-aos-easing="linear"
data-aos-duration="500">
    <div class="container pt-5">
        <h1 class="text mt-5">About Us</h1>
        <!-- <div class="line">
            <hr>
            </hr>
        </div> -->
    
        <p class="paragraph mt-5"> In the emerging global economy, ecommerce has increasingly become a vital component
            of
            business strategy and
            a solid catalyst for economic development. The continued expansion of ecommerce could lead to cost savings,
            and changes in sellers’ pricing behavior.<br><br>In the present, ecommerce websites are very useful
            specially during the pandemic situations, so that people can get stuff they need to their doorsteps without
            travelling, safely. Deliverzy is such a website that allows people to buy day-to-day needs , such as
            vegetables, fruits, dry rations, etc.... .</p>
    
    
    </div><br><br>
    
    <!-- text -->
    
    <div class="container">
        <div class="row feature">
            <div class="col-md-6">
                <h2 class="our mt-5">Our&nbsp;<a class="aim">aim</a></h2><br>
                <p class="paragraph mt-3">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;is to provide
                    you with the best
                    quality<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;day-to-day
                    needs and
                    deliver<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; them
                    as faster
                    as we can......</p>
            </div>
    
            <!-- image -->
    
            <div class="col-md-6 ">
    
                <div class="about-image">
                    <img src="{{ asset('images/about.png') }}">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection