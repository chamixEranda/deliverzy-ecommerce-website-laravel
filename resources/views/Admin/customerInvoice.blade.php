<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <title>Customer Invoice</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-size: 16px;
            font-weight: 300;
            width: 100%;
            background: rgb(204, 204, 204);
            font-family: 'Fira Sans Condensed', sans-serif;
        }
        h2,h4,p{
            margin: 0;
        }
        .page{
            background: #fff;
            display: block;
            margin: 3rem auto 3rem auto;
            position: relative;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }
        .page[size=Ä4]{
            width: 21cm;
            height: 29.7cm;
            overflow-x: hidden;

        }
        .top-section{
            color: #fff;
            padding: 20px;
            height: 115px;
            background-color: #3cbb30;
        }
        .top-section h2{
            font-size: 42px;
            margin-bottom: 10px;
            font-weight: 400;
        }
        .top-section .contact,
        .top-section .address{
            width: 50%;
            height: 100%;
            float: left;
        }
        .top-section .address-content{
            max-width: 275px;
        }
        .contact .contact-content{
            max-width: 220px;
            float: right;
            margin-top: 35px;
        }
        .contact-content .email,
        .contact-content .number{
            display: block;
        }
        .contact-content .email span,
        .contact-content .number span{
            float: right;
            margin-left: 30px;
        }
        .billing-invoice{
            padding: 20px;
            font-size: 20px;
            margin-bottom: 15px;
        }
        .billing-invoice .title{
            font-weight: 400;
            float: left;
        }
        .billing-invoice .des{
            font-weight: 400;
            float: right;
        }
        .billing-invoice .code{
            font-weight: 700;
            text-align: right;
        }
        .billing-invoice .issue{
            text-align: right;
            font-size: 15px;
        }
        .billing-to{
            margin-left: 20px;
        }
        .billing-to .title{
            font-weight: 400;
            font-size: 20px;
            margin-bottom: 7px;
        }
        .billing-to .billed-sec{
            width: 50%;
            float: left;
            font-size: 18px;
            margin-bottom: 25px;
        }
        .billing-to .sub-title,
        .billing-to .name{
            font-weight: 400;
            font-size: 18px;
            margin-bottom: 5px;
        }
        .billing-to .ship-add{
            max-width: 300px;
        }
        .table{
            padding: 0 20px;
        }
        .table table{
            width: 100%;
        }
        .table table, th, td{
            padding: 5px;
            text-align: center;
            border: 1px solid #616161;
            border-collapse: collapse;
        }
        .table tr, th{
            font-size: 18px;
            font-weight: 400;
        }
        .table table th{
            color: #fff;
            background-color: #3cbb30;
        }
        .table tr th:nth-child(2),
        .table tr th:nth-child(2){
            text-align: left;
            width: 230px;
        }
        .bottom-section{
            margin-top: 15px;
            padding: 20px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .bottom-section .status-content h4{
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .bottom-section .status.free::before,
        .bottom-section .status.paid::before{
            padding: 50px 10px;
            border-radius: 5px;
            margin-bottom: 8px;
            display: inline-block;
            text-transform: uppercase;
        }
        .bottom-section .tnx{
            text-align: center;
            margin-top: 10px;
        }

    </style>
</head> 
<body onload="window.print();">
    <div class="page" size="Ä4">
        <div class="top-section">
            <div class="address">
                <div class="address-content">  
                    <h2>DELIVERZY</h2>
                    <p>No.120/5 Vidya Mawatha,<br> Colombo, <br>Western Province <br> Sri Lanka</p>
                </div>
            </div>
            <div class="contact">
                <div class="contact-content">
                    <div class="email"><span class="span">Email :chamith@gmail.com</span></div>
                    <div class="number"><span class="span">Contact: 0741236456</span></div>
                </div>
            </div>
        </div>
        <div class="billing-invoice">
            <div class="title">
                Billing Invoice
            </div>
            <div class="des">
                <p class="code">
                    {{ str_pad($orders->id , 4, '0', STR_PAD_LEFT)}}
                </p>
                <p class="issue">Issued Date: <span>{{ Carbon\Carbon::now()->format('Y-m-d') }}</span></p>
                <p class="issue">Ordered Date: <span>{{ $orders->created_at->format('d/m/Y') }}</span></p>
            </div>
        </div>
        
        <div class="billing-to">
            <div class="title"> Billed To </div>
            <div class="billed-sec">
                <div class="name">
                    Name : {{ $orders->users->firstname.' '. $orders->users->lastname }}
                </div>
                <p>Email: {{ $orders->users->email }}</p>
                <p>{{ $orders->users->mobile }}</p>
            </div>    
            <div class="billed-sec">
                <div class="sub-title">Shipping Address</div>
                <div class="ship-add">{{ $orders->users->home.', '.$orders->users->street.', '.$orders->users->city .', '. $orders->users->province}}</div>
            </div>
        </div>

        @php
            $subTotal = 0 ;
            foreach ($orders->products as $key => $oneCartitem) {
                $subTotal = $subTotal + $oneCartitem->price * $oneCartitem->pivot->quantity;
            }
        @endphp

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product name</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Unit price</th>
                        <th>Sub total</th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach ($orders->products as $oneOrder)
                    <tr>
                        <td>1</td>
                        <td>{{ $oneOrder->name }} </td>
                        <td>{{ $oneOrder->category }}</td>
                        <td>{{ $oneOrder->pivot->order_quantity }}</td>
                        <td>Rs.{{ number_format($oneOrder->price) }}.00/=</td>
                        <td>Rs.{{ number_format($oneOrder->price * $oneOrder->pivot->order_quantity ) }}.00/=</td>
                    </tr>
                    @php
                    $subTotal = 0 ;
                    foreach ($orders->products as $key => $oneCartitem) {
                        $subTotal = $subTotal + $oneCartitem->price * $oneCartitem->pivot->order_quantity;
                    }
                    @endphp
                    @endforeach

                </tbody>
                <tr>
                    <td colspan="5" style="font-weight: 500;">Tax Amount  10%</td>
                    <td>Rs.{{ number_format($subTotal * 10/100)}}.00/=</td>
                </tr>
                <tr>
                    <td colspan="5" style="font-weight: 500;">Grand total</td>
                    <td>Rs.{{ number_format($subTotal * 10/100)+$subTotal }}.00/=</td>
                </tr>
            </table>
        </div>
        <div class="bottom-section">
            <div class="status-content">
                <h4>Payment Status:</h4>
                <p class="status free"></p>
                <p>Payment Method: <span> Cash on Delivery</span></p>
                <p class="tnx">Thanks for shopping with Deliverzy</p>
            </div>
        </div>
    </div>
    
</body>
</html>