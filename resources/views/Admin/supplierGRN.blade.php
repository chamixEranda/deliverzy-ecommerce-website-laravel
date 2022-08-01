<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GRN</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css' rel='stylesheet' />
    <!-- <link rel="stylesheet" href="/static/css/main.css"> -->

    <style>
      body{
  font-family: Calibri, serif;
  font-size: 0.9em;
  padding: 20px;
}

@page {
    margin: 1.2cm 0.5cm; padding-top: 0cm;
    font-size: 0.7em;
    font-family: Calibri, serif;
    @top-left {
      content: "8/24/16";}
    @top-center {
        content: "GRN";}
    @bottom-right {
          content: counter(page)
                  counter(pages);}}

.main-container{
  padding-top: 0.5cm;
  margin:0 auto;
  height:100%;
}
.main-container[size=Ä4]{
  width: 21cm;
  height: 29.7cm;
  overflow-x: hidden;

}

.img-container{
  float:left;
  width:49.7%;
  margin-bottom: 15px;
}
.grn-text{
  overflow: hidden;
  width:95%;
  height:100%;
  text-align: right;
}
.top-padding:before{
  content: '';
  display: block;
  height: 25px;
}
.infos-container{
  margin: 1.5% 0 1% 0;
  height:20%;
}
h4{
  font-size: 1.2em;
  font-weight: 700;
}
h3{
  font-size: 1.25em;
  font-weight: 700;
  margin-top: 2%;
  margin-bottom: 7px;
}
p{
  margin:1px;
}
.company-container{
  width:55%;
  float:left;
}
.client-container{
  overflow: hidden;
}
.client-container table{
  border-collapse: collapse;
}
.client-container table, th, td{
  border:1px solid black;
  padding:1px;
}
.client-container:before{
  content: '';
  display: block;
  height: 16px;
}
.po-container{
  margin-top: 5.5%;
  width:100%;
  height:50%;
}
.po-container table{
  border-collapse: collapse;
  width:100%;
  text-align: center;
  border:1px solid black;
}
.po-container table th{
  font-weight: 800;
  padding: 5px;
}
.po-container table td{
  border-bottom:none;
  border-top:none;
  padding-top: 3px;
}
.left-align{
  text-align:left;
  padding-left: 2px;
}
.blank-row{
  height:535px;
}
.footer-container{
  margin-top:20px;
}
.remark-container table{
  width:100%;
}
.remark-container td:first-child{
  padding-left: 50px;
  width:19%;
  border:none;
}
.remark-container td:last-child{
  border:none;
  border-bottom:1px solid black;
}

.sign-container table{
  border-collapse: collapse;
  width:100%;
  text-align: center;
  border:1px solid black;
  margin-top: 25px;
}
.sign-container table th{
  width:50%;
  font-weight: 800;
  padding: 5px;
}
.sign-container table td{
  border-bottom:none;
  border-top:none;
  padding-top: 5px;
}
.sign-container .bottom-border td{
  padding-top:30px;
}
.bottom-border td hr{
  margin:0 auto;
  border:1px solid black;
  width:80%;
}

    </style>
  </head>
  <body onload="window.print();">
    <div class="main-container" size="A4">
      <header class="header-container">
        <div class="img-container">
          <img src="{{ asset('images/logo.png') }}" alt="acomm_logo" />
        </div>
        {{-- <div class="grn-text">
            <span class="top-padding">GRN No.: 346573</span>
        </div> --}}
      </header>
      <section class="infos-container">
        <div class="company-container">
          <h4>Deliverzy (Pvt).,Ltd.</h4>
          <p>No.120/5 VidyaMawatha,</p>
          <p>Colombo 03</p>
          <h3>Good Receiving Note</h3>
          <p>Vendor Name: {{ $purchaseorder->suppliers->company_name }}Pvt. Lmt</p>
        </div>
        <div class="client-container">
          <table class="client-table">
            <tr>
              <td>CLIENT NAME: {{ $purchaseorder->suppliers->company_name }}Pvt. Lmt</td>
            </tr>
            <tr>
              <td>DATE : {{ $purchaseorder->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
              <td>P.O.NO : {{ $purchaseorder->id }}</td>
            </tr>
            <tr>
              <td>D.O.NO :</td>
            </tr>
            <tr>
              <td>P.O. STATUS : Pending Billing/Partially Received</td>
            </tr>
          </table>
        </div>
      </section>
      <section class="po-container">
        <table>
          <tr>
            <th>No.</th>
            <th>Product Title</th>
            <th>PO Qty</th>
            <th>PO Received</th>
            <th>PO Returned</th>
            <th>Remark</th>
          </tr>
          @foreach ($purchaseorder->purchasing_order_products as $key => $oneOrderProduct)
          <tr>
            <td>{{ $key+1 }}</td>
            <td class="left-align">{{ $oneOrderProduct->product_name }}</td>
            <td>{{ $oneOrderProduct->order_qty }}</td>
            <td>{{ $oneOrderProduct->recieved_qty }}</td>
            <td>{{ $oneOrderProduct->return_qty }}</td>
            <td></td>
          </tr>
          @endforeach  
        </table>
      </section>
      <footer class="footer-container">
        <div class="remark-container">
          <table>
            <td>REMARK :</td>
            <td class="remark-bottom-border"></td>
          </table>
        </div>
        <div class="sign-container">
          <table class="sign-table-container">
            <tr>
              <th>RECEIVED BY WAREHOUSE</th>
              <th>DELIVERED BY</th>
            </tr>
            <tr class="bottom-border">
              <td><hr/></td>
              <td><hr/></td>
            </tr>
            <tr>
              <td>NAME/SIGN/DATE</td>
              <td>NAME/SIGN/DATE</td>
            </tr>
          </table>
        </div>
      </footer>
    </div>
  </body>
</html>
