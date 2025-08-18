<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="{{config('app.name')}} Admin Dashboard">

    <title>{{config('app.name')}} || Admin Register</title>
    <!-- Favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('public/site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('public/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.min.css')}}">
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row" style="justify-content: center; align-items: center;">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form" action="{{ route('admin.storeregister') }}" method="POST">
                        @csrf
                        <div class="header">
                            <img class="logo" src="{{asset('public/images/logo.jpeg')}}" alt=""
                                style="border-radius: 15px;">
                            <h5>Sign Up</h5>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="name">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN
                                UP</button>
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>
                        document.write(new Date().getFullYear())
                        </script>,
                        <span><a href="#">{{config('app.name')}}</a></span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <img src="{{asset('public/images/signin.png')}}" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('public/bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('public/bundles/vendorscripts.bundle.js')}}"></script>
    <!-- Lib Scripts Plugin Js -->
</body>


</html>