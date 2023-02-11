<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amarlinux.in</title>

    <link rel="manifest" href="/site.webmanifest">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
    <link rel="icon" href="{{asset('image/amarlinux.png')}}" type="image/png" sizes="32x32"> 
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
             
      <style type="text/css">
        @yield('maincss')
      </style> 


 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm ">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">


                    <span style="font-size:20px;font-variant: small-caps;letter-spacing:2px;text-shadow: 3px 3px purple;"><img src="{{asset('image/amarlinux.png')}}" width="30" height="30">marlinux.com</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item text-info">
                                <a class="nav-link text-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item text-info" >
                                    <a class="nav-link text-info" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role == 'admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown " class="nav-link text-info" style="font-variant: small-caps;font-size: 20px;"  href="#">
                                  Mr. {{ Auth::user()->name }}
                                </a>

                                
                            </li>
                            
                            <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                             @csrf
                            <button class="nav-link btn btn-primary " style="width:80px;"   type="submit">
                            {{ __(' Logout ') }}
                             </button>
                             </form>
                             </li>
                             @endif

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       
        <main class="py-4">

            @yield('content')
        </main>
        @yield('js')
       
    </div>
         

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>


</body>
</html>
