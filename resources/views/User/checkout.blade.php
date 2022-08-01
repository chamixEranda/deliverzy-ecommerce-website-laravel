@extends('layouts.app');

@section('title', 'Checkout - ')
    
@section('content')
<div class="container">
    <h2 class="text">Checkout</h2><br>
</div>

<div class="container">
    <h3>Shipping Details</h3>
</div>
@php
      $subTotal = 0 ;
      foreach (Auth::user()->carts->products as $key =>  $oneCartProduct) {
          $subTotal = $subTotal + $oneCartProduct->price * $oneCartProduct->pivot->quantity;
      }
@endphp

<div class="container">
    <div class="row">
        
        <div class="col-lg-5">
            <table class="table table-borderless checkoutViewTables">
                <tbody>                
                    <tr>
                        <td><b>Name:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}.</td>
                    </tr>
                    <tr>
                        <td><b>E-mail:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->email }}.</td>
                    </tr>
                    <tr>
                        <td><b>Phone:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->mobile }}.</td>
                    </tr>
                    <tr>
                        <td><b>Home No:</b></th>
                        <td class="checkouttbl">No:{{ Auth::user()->home }}.</td>
                    </tr>
                    <tr>
                        <td><b>Street:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->street }}.</td>
                    </tr>
                    <tr>
                        <td><b>City:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->city }}.</td>
                    </tr>
                    <tr>
                        <td><b>Province:</b></th>
                        <td class="checkouttbl">{{ Auth::user()->province }}.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div><br>

<form action="{{ route('user.placeOrder') }}" method="POST" autocomplete="off">
@csrf
    <div class="container">
        <h3>Select Payment Method</h3>
    </div>

    <div class="container">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="paymentMethod" id="flexRadioDefault1" value="C" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                Cash On Delivery
            </label>
        </div>
    </div><br>

    <div class="container chekout-summary">
        <h3>Cart Summary</h3>
        <div class="row srow">
            <div class="col-lg-6">
                <table class="table table-borderless checkoutViewTables">
                    <tbody>
                        <tr>
                            <td><b>Sub Total</b></th>
                            <input type="hidden" name="subTotal" value="{{ $subTotal}}">
                            <td class="checkout-summery-Tables-data">Rs.{{ number_format($subTotal) }}</td>
                        </tr>
                        <tr>
                            <td><b>Tax 0%</b></th>
                            <input type="hidden" name="tax" value="{{ ($subTotal - ($subTotal * env('DISCOUNT_RATE') / 100) * env('TAX_RATE') / 100) }}">
                            <td class="checkout-summery-Tables-data">Rs.{{ number_format(($subTotal - ($subTotal * env('DISCOUNT_RATE') / 100)) * env('TAX_RATE') / 100) }}</td>
                        </tr>
                        <tr>
                            <td><b>Amount Discounted</b></th>
                            <input type="hidden" name="discount" value="{{ ($subTotal * env('DISCOUNT_RATE') / 100 ) }}">
                            <td class="checkout-summery-Tables-data">Rs.{{ number_format( $subTotal * env('DISCOUNT_RATE') / 100 ) }}</td>
                        </tr>
                        <td colspan="2"><hr></td>
                        
                        <tr>
                            <td><b>Grand Total</b></th>
                            <input type="hidden" name="total_bill" value="{{ ($subTotal * env('DISCOUNT_RATE') / 100 ) }}">
                            <td class="cart-summery-Tables-data">Rs.{{ number_format(($subTotal  - ($subTotal * env('DISCOUNT_RATE') / 100 )) +
                            (($subTotal - ($subTotal * env('DISCOUNT_RATE') / 100)) * env('TAX_RATE') / 100)) }}</td>
                        </tr>
                    </tbody>
                </table>
                

            </div>

        </div>
    </div>

    <div class="Order">
        <button class="btn checkout-btn" type="submit" id="button-addon2"><i class="fas fa-shopping-bag me-1"></i>Order</button>
    </div>
    <br><br>
</form>

@endsection