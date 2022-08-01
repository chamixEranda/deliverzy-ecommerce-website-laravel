<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>@yield('title') {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    {{-- datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-1.1 shadow">
        <a class="navbar-brand col-md-3 col-lg-3 me-0 px-3" href="#"><img src="{{ asset('images/logo1.png') }}"width="170px"></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="{{ route('admin.logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>

          </div>
        </div>
      </header>


@yield('content')

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-lg-3  col-lg-2 d-md-block  sidebar collapse ">
                <div class="position-sticky pt-5">
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="{{ request()->is('/admin/dashboard') ? 'dash-btn-active' : '' }}nav-link  btn dash-btn  pt-3 pb-3"  href="{{ route('admin.Dashboard') }}">
                                DASHBOARD
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="{{ request()->is('/admin/products') ? 'dash-btn-active' : '' }}nav-link btn dash-btn  pt-3 pb-3" href="{{ route('admin.Products') }}">
                                PRODUCT
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.Orders') }}">
                                ORDERS
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.delivers') }}">
                                DELIVERIES
                            </a>
                        </li>

                        <li class="nav-item  ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.DeliverPerson') }}">
                               DELIVERY PERSONS
                            </a>
                        </li>

                        {{-- <li class="nav-item  ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.DP-Home') }}">
                               PAYMENTS
                            </a>
                        </li> --}}

                        <li class="nav-item  ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.Suppliers') }}">
                               SUPPLIERS
                            </a>
                        </li>

                        <li class="nav-item  ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.PurchasingRequest') }}">
                               PURCHASING REQUEST
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link btn  dash-btn pt-3 pb-3" href="{{ route('admin.reports') }}">
                                REPORTS
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>



        </div>
    </div>

</body>

<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('pluggins/jquery.multifield.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
<script src="{{ asset('js/countMe.min.js') }}"></script>
<script>
    $('#example-1').multifield();
</script>

<script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>

<script>
function getImagePreview(event)
{
  var image=URL.createObjectURL(event.target.files[0]);
  var imagediv= document.getElementById('previewAdd');
  var newimg=document.createElement('img');
  imagediv.innerHTML='';
  newimg.src=image;
  newimg.width="400";
  newimg.height="200";
  newimg.className = "border border-dark img-fluid mb-3";
  imagediv.appendChild(newimg);
}

function getImageEdit(event)
{
  var image=URL.createObjectURL(event.target.files[0]);
  var imagediv= document.getElementById('previewEdit');
  var newimg=document.createElement('img');
  imagediv.innerHTML='';
  newimg.src=image;
  newimg.width="400";
  newimg.height="200";
  newimg.className = "border border-dark img-fluid mb-3";
  imagediv.appendChild(newimg);
}


</script>

@yield('javascript')
</html>
