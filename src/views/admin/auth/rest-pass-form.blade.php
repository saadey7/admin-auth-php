<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="{{config('app.name')}} Client Dashboard">

    <title>{{config('app.name')}} || {{__('Admin')}} {{__('Login')}}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{asset('public/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{asset('public/favicon.svg')}}" />
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/apple-touch-icon.png')}}" />
    <meta name="apple-mobile-web-app-title" content="Job Finder" />
    <link rel="manifest" href="{{asset('public/site.webmanifest')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
     
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('public/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.min.css')}}">
    
    <!--Dark Mode Css-->
    <link rel="stylesheet" href="{{asset('public/client/css/darkstyle.css')}}">

    <style>
        a{
            color: #0c7ce6;
        }
        a:hover{
            color: #0c7ce6;
        }
        .textDiv{
            text-align: right;
        }
        .form-control{
            border-radius: 10px;
        }
        label{
            font-family: 'Outfit';
            color: #717171;
            font-weight: 500;
            font-size: 16px;
        }
        .form-control::placeholder{
            font-family: 'Outfit';
            color: #999DA0;
            font-weight: 400;
            font-size: 14px;
        }
        .firstDivtext{
            font-family: 'Outfit';
            color: #fff;
            font-weight: 500;
            font-size: 30px;
            position: absolute;
            bottom: 0;
            padding: 22px;
            margin-bottom: 0;
        }
        
        @media (max-width: 768px){
            .textDiv{
                text-align:  center;
            }
        }
        .formDiv::after {
            content: "";
            background: url({{asset('public/client/images/ellipse.png')}});
            background-size: cover;
            background-repeat: no-repeat;
            position: absolute;
            width: 380px; /* Set width */
            height: 475px; /* Set height */
            bottom: 0; /* Adjust positioning */
            right: 0; /* Adjust positioning */
            z-index: -1; /* Ensure it's behind the content */
            /*opacity: 10%;*/
            border-radius:  100%;
        }
        
        .formDiv::after {
            content: "";
            background: url({{asset('public/client/images/ellipse.png')}});
            background-size: cover;
            background-repeat: no-repeat;
            position: absolute;
            width: 380px; /* Set width */
            height: 475px; /* Set height */
            bottom: 0; /* Adjust positioning */
            right: 0; /* Adjust positioning */
            z-index: -1; /* Ensure it's behind the content */
            /*opacity: 10%;*/
            border-radius:  100%;
        }
        
        .toggle-container {
          width: 100px;
          height: 40px;
          display: flex;
          flex-direction: row;
          background-color: #f2f2f2;
          border-radius: 20px;
          padding: 5px;
        }
        
        .toggle-button {
          width: 45px;
          border-radius: 20px;
          display: flex;
          align-items: center;
          justify-content: center;
          background-color: transparent;
          border: none;
          cursor: pointer;
        }
        
        .toggle-button img {
          height: 20px;
        }
        .dark-mode .toggle-container{
            background-color: #383839;
        }
        .dark-mode {
            background: #121212 !important;
        }
    </style>
</head>

<body class="theme-blush" style="background: #fff; background-attachment: fixed;">
    <div class="row" style="justify-content: center; align-items: center; margin:0px; padding: 20px 0px; border-bottom: 1px solid #D8D8D8; position: relative;">
        <img src="{{asset('public/client/images/jobBlack.png')}}" id="brand-logo" alt="Sign In" style="width: 15%;"/>
        
          {{-- Theme Toggle --}}
        <div class="toggle-container modeChange" id="main-Div" style="position: absolute; right: 0px;">
          <button class="toggle-button dark" onclick="setLight('dark')" id="darkBtn">
            <img src="{{ asset('public/icons/moon-light.png') }}" id="moon" alt="Moon" />
          </button>
          <button class="toggle-button light" onclick="setLight('light')" id="lightBtn">
            <img src="{{ asset('public/icons/sun-blue.png') }}" id="sun" alt="Sun" />
          </button>
        </div>
    </div>
    <div class="row" style="justify-content: center; align-items: center; margin: 0px;">
        <div class="col-md-6 col-sm-12 p-0 d-none d-md-block" style="height: 100vh; background: url({{asset('public/client/images/loginBg.png')}}); background-size: cover;">
            <p class="firstDivtext">Voer je e-mailadres in om instructies voor het opnieuw instellen van je wachtwoord te ontvangen.</p>
        </div>
        <div class="col-md-6 col-sm-12 p-0 formDiv" style="height: 100vh;">
            <div class="row justify-content-center" style="margin-top: 50px;">
                <div class="col-md-10 col-sm-11">
                    <form class="auth_form" method="POST" action="{{ route('admin.forgot') }}">
                        @csrf
                        <div class="header text-left">
                            <button type="button" class="btn btn-primary mb-5" style="background: transparent; border: 1px solid #212121; border-radius: 32px; color: #212121; font-size: 16px" onClick="window.history.back();"><img src="{{asset('public/client/images/arrow-left.png')}}" width="20px">&nbsp;&nbsp;{{__('Back')}}</button>
                            <h1 class="job"  style="font-family: 'Outfit'; margin-bottom: 16px;">{{__('Forgot Password')}}</h1>
                            <p class="job" style="font-family: 'Outfit';">{{__('Vind wat u nodig hebt en breng u in contact met de gemeenschappen die er het meest toe doen.') }}</p>
                        </div>
                        <div class="body p-0" style="box-shadow: none;">
                            <label class="job">{{__('Email Address')}}</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="{{__('Enter your email address')}}" name="email" required>
                            </div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light" style="background-color: #307BF4 !important; line-height: 2.35em; border-radius: 40px; font-size: 18px; font-weight: 800; font-family: 'DM Sans';">{{ __('Send Otp') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    @include('client.pages.toastr')
    <!-- Jquery Core Js -->
    <script src="{{asset('public/bundles/libscripts.bundle.js')}}"></script>
    <script src="{{asset('public/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
    <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("passwordInput");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.replace("zmdi-eye", "zmdi-eye-off");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.replace("zmdi-eye-off", "zmdi-eye");
        }
    }
</script>


    <script>
        const lightMode = "{{ asset('public/icons/lightmode.png') }}";
        const darkMode = "{{ asset('public/icons/darkmode.png') }}";
        const logoLightMode = "{{ asset('public/client/images/jobBlack.png') }}";
        const logoDarkMode = "{{ asset('public/client/images/jobfinder.png') }}";
        const sunIconLightMode = "{{ asset('public/icons/sun-blue.png') }}";
        const sunIconDarkMode = "{{ asset('public/icons/sun-light.png') }}";
        const moonIconLightMode = "{{ asset('public/icons/moon-dark.png') }}";
        const moonIconDarkMode = "{{ asset('public/icons/moon-light.png') }}";
        
        function setLight(mode) {
            const brandLogo = document.getElementById('brand-logo');
            const darkBtn = document.getElementById('darkBtn');
            const lightBtn = document.getElementById('lightBtn');
            const iconSunImg = document.getElementById('sun');
            const iconMoonImg = document.getElementById('moon');
            const mainDiv = document.getElementById('main-Div');
        
            if (mode === 'dark') {
              document.body.classList.add("dark-mode");
              iconSunImg.src = sunIconDarkMode;
              iconMoonImg.src = moonIconDarkMode;
              brandLogo.src = logoDarkMode;
              darkBtn.style.backgroundColor = "#4d4d4d";
              lightBtn.style.backgroundColor = "transparent";
              mainDiv.style.borderWidth = "1px";
              mainDiv.style.borderColor = "#4d4d4d";
              mainDiv.style.borderStyle = 'solid';
              localStorage.setItem("theme", "dark");
            } else {
              document.body.classList.remove("dark-mode");
              brandLogo.src = logoLightMode;
              iconSunImg.src = sunIconLightMode;
              iconMoonImg.src = moonIconLightMode;
              darkBtn.style.backgroundColor = "transparent";
              lightBtn.style.backgroundColor = "white";
              mainDiv.style.borderWidth = "0px";
              localStorage.setItem("theme", "light");
            }
        }
        
          window.onload = function () {
            const theme = localStorage.getItem("theme");
            setLight(theme === "dark" ? "dark" : "light");
          };
    </script>

</body>


</html>