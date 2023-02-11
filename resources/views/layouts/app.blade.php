 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Amarlinux.in</title>
    <link rel="manifest" href="/site.webmanifest">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{asset('image/amarlinux.png')}}" type="image/png" sizes="32x32"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://js.stripe.com/v3/"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


 <style type="text/css">
   
 ul.as li{
    float:left;


 } 


 :root {
  --jumbotron-padding-y: 3rem;
}

.jumbotron {
  padding-top: var(--jumbotron-padding-y);
  padding-bottom: var(--jumbotron-padding-y);
  margin-bottom: 0;
  background-color: #fff;
}
@media (min-width: 768px) {
  .jumbotron {
    padding-top: calc(var(--jumbotron-padding-y) * 2);
    padding-bottom: calc(var(--jumbotron-padding-y) * 2);
  }
}

.jumbotron p:last-child {
  margin-bottom: 0;
}

.jumbotron-heading {
  font-weight: 300;
}

.jumbotron .container {
  max-width: 40rem;
}

footer {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

footer p {
  margin-bottom: .25rem;
}


 </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
           <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">


                    <span style="font-size:20px;font-variant: small-caps;letter-spacing:2px;text-shadow: 3px 3px purple;"><img src="{{asset('image/amarlinux.png')}}" width="30" height="30">marlinux.com</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                 
                       <!--   <form class="form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select name="category" class="custom-select">
                                        <option selected>All</option>
                                        @isset($cat)
                                        @foreach($cat as $cate)
                                         <option value="{{$cate->id}}" style="font-size:9px;">{{$cate->title}}</option>

                                        @endforeach
                                     
                                        @endisset
                                    </select>
                                </div>
                                <input type="search" style="width: 50%;" name="searchbar" placeholder="Search Products...." class="form-control">
                                 <div class="input-group-append">
                                <button class="btn btn-success">Search</button>
                            </div>
                                
                            </div>
                              
                          </form>-->       
                    

                         
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-info" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-info"  href="#">
                                   Hi,{{ Auth::user()->name }}
                                </a>

                                
                            </li>
                            <li>
                                
                 <div class="dropdown">
                 <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">Your Account</a>
                 <div class="dropdown-menu">
                 <a href="{{route('userprofile.index')}}" class="dropdown-item">Your Account</a>
                 <a href="{{ route('userprofile.edit',Auth::user()->id) }}" class="dropdown-item">Your Profile</a>
                 <a href="{{route('userorders.index')}}" class="dropdown-item">Your Orders</a>
                 <a href="{{route('userreturn.index')}}" class="dropdown-item">Your Return</a>
                 <a href="{{ route('userpayment.index') }}" class="dropdown-item">Your Payments</a>

                 <a href="{{ route('userprofile.show',Auth::user()->id) }}" class="dropdown-item">Delete Account</a>
                 <a href="" class="dropdown-item">
                 <form id="logout-form" action="{{ route('logout') }}" method="POST">
                 @csrf
                 <button class="nav-link btn btn-muted btn-sm"   type="submit">
                            <b>{{ __('Sign Out') }}</b>
                 </button>
                 </form>
                 </a>


                     
                 </div>
                                    
                 </div>


                 </li>
                            
                 

                 @endguest
                    </ul>
                     
                     <div class="text-white ">
                       <a href="{{ route('yourcard') }}"  style="text-decoration: none;"> <img src="{{asset('image/hiclipart.com.png
                            ')}}" width="40" height="30">

                            @if(isset($cart) && $cart->getContents())

                                Your Cart [{{$cart->getTotalQty()}}]

                            @else

                               Your Cart[0]

                            @endif


                            </a>
                         
                     </div>

                </div>
            </div>
        </nav>
       
        <nav class="navbar navbar-expand-sm  navbar-light bg-white  shadow">
            <div class="container">
            
              <div class="row ">
              
           
            
              <div class="col-sm-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-dark">check delivery status</button>
                    
                  </div>

                     <input type="text" name="pin" id="pin" class="form-control" pattern="[0-9]{6}" placeholder="Enter Your pincode">
                    
                  
                </div>

            
               </div>
                   
               </div>


            <ul class="navbar-nav bg-muted ml-5" >
            <!-- <li class="nav-item "> <a href="#" class="nav-link  text-dark shadow-sm ">Top Deals</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">electronic</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">Fashion's</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">Mobiles</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">Computers</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">New Releases</a> </li>
             <li class="nav-item "> <a href="#" class="nav-link text-dark shadow-sm">Books</a> </li>-->
             <li class="ml-4"><span id="result" class="badge badge-primary" style="font-size: 11px;"></span></li>


            </ul>

         
              
            </div>
             

           <div >
           
           
         
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
  
    <script src="https://js.stripe.com/v3/"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>




<script type="text/javascript">
 
 $(document).ready(function (){

 $('#pin').on('change',function(){

     var pin = $(this).val();

  if(pin !== "")
  {

      $.ajax({

        url:"{{route('pincode.index')}}",
        method:"GET",
        data:{pin:pin},
        success:function(data)
        {
            $("#result").html(data);
        }




      });

  }



 });


 });  

</script>
</body>
</html>
