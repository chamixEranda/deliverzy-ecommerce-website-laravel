<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo_Ss5_icon.ico') }}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>@yield('title') {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body> 
<style>
.navbar-expand-lg .navbar-nav .nav-link {
    padding-right: 1.5rem;
    padding-left: 0.5rem;
}
.navbar-expand-lg .navbar-nav .nav-item .nav-link:hover{
    color: #69e95d;
}
.nav-link{
    color: #5cc952 !important;
    font-weight: 600;
}
.navbar-expand-lg{
    z-index: 999;
    top: 0;
    width: 100%;
    background: #fff;
    position: fixed;
    border-bottom: 1px solid rgba(255, 255, 255, 0);
}
.navbar-expand-lg .navbar-nav .sign-btn{
    background: #5cc952;
    border-radius: 5px;
    margin-left: 10px;
}
.navbar-expand-lg .navbar-nav .sign-btn a{
    text-align: center;
    color: #fff !important;
    padding: 8px 15px 0px 15px;
}
.navbar-expand-lg .navbar-nav .sign-btn:hover{
    background: #69e95d;
}
.navbar-expand-lg .navbar-nav .login-btn a{
    padding: 8px 15px 8px 15px;
}
.login-btn a:hover{
    border-radius: 5px;
    background: #F0F0F0 !important;
    color: #5cc952 !important;  
}
.dropdown .user-dropdown{
    color: #5cc952 !important;  
    font-weight: 600;
}

</style>


    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid nav-container">
            <a class="navbar-brand" href="{{ route('Home') }}"><img src="{{ asset('images/logo.png') }}" width="200px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            @auth
                <div class="" id="navbarNav">
                    <ul class="navbar-nav navbar-Elements" style="margin-right: 20px">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Categories') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('About-us') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Contact-us') }}">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.My-Cart') }}"><i class="bi bi-cart-fill"></i> My Cart</a>  
                        </li>
                        <div class="dropdown" style="margin-right: 20px;">
                            <button class="btn user-dropdown dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle fa-lg"></i> {{ Auth::user()->firstname }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="{{ route('user.My-Orders') }}"><i class="bi bi-bag-check-fill"></i> My Orders</a></li>
                              <li><a class="dropdown-item" href="{{ route('user.My-Wishlist') }}"><i class="bi bi-chat-right-heart-fill"></i> Wishlist</a></li>
                              <li><a class="dropdown-item" href="{{ route('user.EditProfile') }}"><i class="bi bi-person-plus-fill"></i> Edit Profie</a></li>
                              <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Log Out</a></li>
                                <form action="{{ route('user.logout') }}" method="POST" class="d-none" id="logout-form">@csrf</form>
                            </ul>
                          </div>
                    </ul>
                </div>
            @else
                <div class="" id="navbarNav">
                    <ul class="navbar-nav navbar-Elements" style="margin-right: 20px">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Categories') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('About-us') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Contact-us') }}">Contact Us</a>
                        </li>
                        <li class="nav-item login-btn">
                            <a class="nav-link " href="{{ route('user.Login') }}">Login</a>
                        </li>
                        <li class="nav-item sign-btn">
                            <a class="nav-link" href="{{ route('user.Signup') }}">Sign Up</a>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </nav>
      
    <!-- navbar end -->

    <!-- toggle -->
@yield('content')

    <!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted" >
    <!-- Section: Social media -->
    <section
      class="d-flex justify-content-center justify-content-lg-between p-3 border-bottom"
    >
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->
  
      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>DELIVERZY
            </h6>
            <p>
              Here you can use rows and columns to organize your footer content. Lorem ipsum
              dolor sit amet, consectetur adipisicing elit.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Products
            </h6>
            <p>
              <a href="#!" class="text-reset">Baverages</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Vegetables</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Fruits</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Dry Rations</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Quick links
            </h6>
            <p>
              <a href="#!" class="text-reset">Our Story</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Contact Us</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Categories</a>
            </p>
            
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>
            <p><i class="fas fa-home me-3"></i> No.120/5 Vidya Mawatha, Colombo</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              deliverzylanka@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> (+94) 71 234 5678</p>
            <p><i class="fas fa-print me-3"></i> (+94) 11 987 6543</p>
          </div>
          <!-- Grid column -->
        </div>
        <div class="text-center">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">Deliverzy.com</a>
          </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

@yield('javascript')
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>

</html>