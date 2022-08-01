@extends('layouts.app')

@section('title', 'viewOrders - ')
    
@section('content')
<div class="container pt-5">
    <h2 class="text mt-5">My Orders</h2><br>

</div>
{{-- order conform message --}}
@if (Session::get('order-conform'))
<div class="modal fade" id="order-conform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <img src="{{ asset('img/logo 1.png') }}" width="40" height="32">
        <h5 class="modal-title ms-2 orderConform-title" id="staticBackdropLabel">Thank you for your order!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 class="orderConform-message-head">{{ Session::get('order-conform') }}</h5>
        <p class="orderConform-message-message">We will email you, your order details and tracking information</p>
      </div>
      <div class="modal-footer">
        <a href="/" type="button" class="btn btn-primary rounded-0 orderConform-message-btn">Continue shopping</a>
      </div>
    </div>
  </div>
</div>
@endif

<div class="container mt-3 " data-aos="zoom-in">
  <div class="order-details">
    <div class="row my-4">
      <div class="col">
        <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg" style="width: 95%" id="ordersTable">
          <thead> 
            <tr>
              <th scope="col" >ORDER NO.</th>
              <th scope="col">ORDER DATE</th>
              <th scope="col">BILL AMOUNT</th>
              <th scope="col">STATUS</th>
              <th scope="col">ACTION</th> 
            </tr>
          </thead>
          <tbody> 
            @forelse (Auth::user()->orders as $Oneorder)  
              <tr>
                <th scope="row">#00{{ $Oneorder->id }}</th>
                <?php 
                    $datetime = new DateTime($Oneorder->created_at)
                ?>

                <td>{{$datetime->format('Y')}}-{{$datetime->format('M')}}-{{$datetime->format('d')}}</br>  
                {{$datetime->format('h')}}:{{$datetime->format('i')}} {{$datetime->format('A')}}</td>

                <td>Rs.{{ number_format(($Oneorder->invoices->total_bill - $Oneorder->invoices->discountAmount) + 
                $Oneorder->invoices->taxAmount) }}.00/=</td>

                <td>
                    @if ($Oneorder->deliveries->deliver_status == 'P')
                    <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span>
                    
                </td>
                    @elseif($Oneorder->deliveries->deliver_status == "Pr")
                    <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                    @elseif($Oneorder->deliveries->deliver_status == "C")
                    <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                    @endif
                <td><a href="" type="button" class="btn btn-info small text-light" value="View">
                  <i class="fas fa-fw fa-info-circle"></i>View</a>
                </td>
              </tr>
            @empty
              <tr>
                  <td colspan="6">There are no orders to display</th>  
              </tr>                 
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br>

@endsection

@section('javascript')
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
        el.classList.toggle("toggled");
        };

        $("#ordersTable").simplePagination({

          // the number of rows to show per page
          perPage: 8,

          // CSS classes to custom the pagination
          containerClass: '',
          previousButtonClass: 'btn btn-primary border-0',
          nextButtonClass: 'btn btn-primary border-0',

          // text for next and prev buttons
          previousButtonText: 'Previous',
          nextButtonText: 'Next',

          // initial page
          currentPage: 1
        });
      </script>

      @if (Session::get('order-conform'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#order-conform').modal('show');
            });
        </script> 
      @endif


@endsection