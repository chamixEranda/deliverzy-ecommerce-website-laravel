<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/admin.css')  }}">
    <title>Delivery Person Login</title>
</head>
<body>
    <div class="container  deliverypersonlogin">
        <img src="{{ asset('images/logo.png') }}" alt="" style="width: 200px; height: 50px">
        <h2 style="text-align: center;">DELIVERZY DELIVER</h2>
        <form action="{{ route('delivery-person.check') }}" method="POST" autocomplete="off">
            @csrf
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            <div class="form-group">
                <label for="">Email Address</label>
                <input type="text" class="form-control  deliveryprson" name="email" value="{{ old('email') }}">
                <span class="text-danger">@error('email'){{ $message }} @enderror</span>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control deliveryprson" name="password" value="{{ old('password') }}">
                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
            </div><br>
            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</body>
</html>