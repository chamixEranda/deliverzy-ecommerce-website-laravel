<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    body {
      width: 230mm;
      height: 100%;
      margin: 0 auto;
      padding: 0;
      font-size: 12pt;
      background: rgb(204, 204, 204);
    }

    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .main-page {
      width: 210mm;
      min-height: 297mm;
      margin: 10mm auto;
      background: white;
      box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    .sub-page {
      padding: 1cm;
      height: 297mm;
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .main-page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }
  </style>
</head>

<body onload="window.print();">

  <body>
    <div class="main-page">
      <div class="sub-page">
        <br>
        <h2 align='center'>Deliverzy</h2>
        <h5 align='center'>Monthly Order Deliver Report</h5>
        <h5 align='center'>{{ $request->fromDate.' to '.$request->toDate }}</h5>
        <br><br>
        <p style="text-align:left;">
          Date : {{ Carbon\Carbon::now()->format('Y-m-d') }}
          <span style="float:right;">
            Page 1
          </span>
        </p>
        <br>
        <br>
        <table class="table table-bordered mt-7">
          <thead>
            <tr>
              <th scope="col">DELIVERY ID</th>
              <th scope="col">CUSTOMER ADDRESS</th>
              <th scope="col">ORDER ID</th>
              <th scope="col">TOTAL BILL</th>
              <th scope="col">DELIVER STATUS</th>
              <th scope="col">INVOICE NO</th>
              <th scope="col">ORDERED DATE</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($data as $oneData)
            <tr>

              <td>{{ $oneData->id }}</td>
              <td>{{ $oneData->orders->users->home.', '.$oneData->orders->users->street.', '. 
              $oneData->orders->users->city.', '.$oneData->orders->users->province}}</td>
              <td>{{ $oneData->orders->id }}</td>
              <td>{{ number_format($oneData->orders->invoices->total_bill)}}.00/=</td>
              <td>
                @if($oneData->deliver_status == "P")
                Pending
              @elseif($oneData->deliver_status == "Pr")
                Processing
              @else
                Completed
              @endif
              </td>
              <td>{{ $oneData->orders->invoices->id }}</td>
              <td>{{ $oneData->orders->created_at }}</td>
            </tr>
            @endforeach
            {{-- <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr> --}}


          </tbody>
        </table>

        <br>
        <br>
        <br>
        <br>
        <p style="text-align:left;">
          ..........................
          <span style="float:right;">
            ..........................
          </span>
        <p style="text-align:left;">
          Signature
          <span style="float:right;">
            Date
          </span>

      </div>

    </div>
  </body>

</body>



</html>