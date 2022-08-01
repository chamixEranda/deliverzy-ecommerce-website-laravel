@extends('layouts.admin')

@section('title', 'Dashboard - ')
    
@section('content')

<div class="container-fluid  col-lg-6  px-4 ">
    <div class="row fist-three g-2 my-2">
        <div class=" anlyze-box ">
            <div class="p-3 bg-dark shadow-sm d-flex justify-content-around align-items-center rounded" style="width: 23rem;margin-left:2rem">
                <span style="font-size: 3rem">+</span>
                <div>
                    <h2 class="fs-1" id="pro-count">{{ $pro }}</h2>
                    <p class="fs-5">Products</p>
                </div>
                <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>

        <div class=" anlyze-box ">
            <div class="p-3 bg-dark shadow-sm d-flex justify-content-around align-items-center rounded" style="width: 23rem;margin-left:10rem">
                <span style="font-size: 3rem">+</span>
                <div>
                    <h2 class="fs-1" id="delivery-count">{{ $dalivery }}</h2>
                    <p class="fs-5">Delivery</p>
                </div>
                <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>
    </div>
</div>
    

<div class="container-fluid  col-lg-6  px-4">
    <div class="row fist-three g-2 my-2">

        <div class=" anlyze-box">
            <div class="p-3 bg-dark shadow-sm d-flex justify-content-around align-items-center rounded" style="width: 23rem;margin-left:2rem">
                <span style="font-size: 3rem">+</span>
                <div>
                    <h2 class="fs-1" id="order-count">{{ $c_orders }}</h2>
                    <p class="fs-5">Completed Orders</p>
                </div>
                <i class="fas fa-shopping-bag fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
            
        </div>

        <div class=" anlyze-box">
            <div class="p-3 bg-dark shadow-sm d-flex justify-content-around align-items-center rounded" style="width: 23rem;margin-left:10rem">
                <span style="font-size: 3rem">+</span>
                <div>
                    <h2 class="fs-1" id="porder-count">{{ $p_orders }}</h2>
                    <p class="fs-5">Pending Orders</p>
                </div>
                <i class="fas fa-shopping-bag fs-1 primary-text border rounded-full secondary-bg p-3"></i>
            </div>
        </div>
    </div>

    <div class="card-body">
        <canvas class="chart" width="400" height="200" id="salsechart"></canvas>
    </div>
</div>    

    

@endsection
<script>
    window.onload = ()=>{
        // $(selector).countMe(delay,speed)
        $("#pro-count").countMe(40,60);
        $("#sale-count").countMe(40, 60);
        $("#delivery-count").countMe(40, 60);
        $("#order-count").countMe(40,60);
        $("#porder-count").countMe(40,60);
     }
</script>
<script>
    const charts2 = document.querySelectorAll("#salsechart");

charts2.forEach(function (chart) {
    var cData = <?php echo json_encode($sales_chart_data)?>;
    var ctx = chart.getContext("2d");
    var myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: cData.label,
            datasets: [
                {
                    label: new Date().getFullYear() + " Sales",
                    data: cData.data,
                    borderColor: [
                        "rgba(0, 0, 0)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            }, 
        },
    });
});
</script>