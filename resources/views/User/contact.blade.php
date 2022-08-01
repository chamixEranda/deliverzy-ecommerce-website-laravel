@extends('layouts.app')

@section('title', 'Contact - ')
    
@section('content')
<div class="container  pt-5">
    <h1 class="text-contact mt-5">Contact Us</h1>
</div><br><br>




<!-- Right box with form -->

<div class="container " data-aos="zoom-in">

    <div class=" container  contact-right"><br>

        <p class="send">Send Message</p><br>
        


        <div class="input-group mb-4 ms-5">

            <input type="text" class="form-control" placeholder="Name" aria-label="name"
                aria-describedby="basic-addon1">
        </div>

        <div class="input-group  mb-4 ms-5">

            <input type="text" class="form-control " placeholder="Email *" aria-label="mail"
                aria-describedby="basic-addon1">
        </div>


        <div class="input-group  mb-4 ms-5">

            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                placeholder="Message *"></textarea>
        </div>

        <button type="submit" class="btn btn-light btn-contact mt-5">Send</button>

    </div>
</div>
@endsection