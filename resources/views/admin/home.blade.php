@extends('admin.main')
@section('maincss')
  
body {
  font-size: .875rem;
}

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}


.sidebar {
  position: relative;
  top: 0%;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}


.navbar .navbar-toggler {
  top: .25rem;
  right: 1rem;
}

a:hover{
   
   text-decoration:none;
}



@endsection

@section('content')
  
<div class="container-fluid ">
 
  <nav class="navbar navbar-dark  bg-gray flex-md-nowrap  " style="width: 100%;">
  <a class="navbar-brand  text-dark " style="width:19%;" href="{{route('adminpanel.index')}}">Admin Dashboard</a>
  <button class="navbar-toggler text-dark position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon bg-dark"></span>
  </button>
  <input class="form-control " type="text" placeholder="Search" aria-label="Search">

</nav>

        @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
        @endif

        @if(Auth::user()->email_verified_at == Null)   
             <div class="card">

             <div class="card-header">{{ __('Verify Your Email Address') }}</div>

             <div class="card-body">
             @if (session('resent'))
             <div class="alert alert-success" role="alert">
             {{ __('A fresh verification link has been sent to your email address.') }}
             </div>
             @endif

              {{ __('Before proceeding, please check your email for a verification link.') }}
              {{ __('If you did not receive the email') }},
           
              <form class="d-inline" method="POST"  action="{{ route('admin.resend')}}" >                 @csrf
              <input type="hidden" name = "id" value="{{Auth::user()->id}}">
              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
              </form>
              </div>
              </div>
              @else


                    
             @endif
                
    
  
             <div class="row">
            

             @include('admin.navbar')
             


             <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      

             @include('admin.admins.admin')
             @include('admin.category.category')
             @include('admin.product.product')
             @include('admin.customers.customer')
             @include('admin.customers.order')
             @include('admin.product.return')
             
         
             </main>
             </div>

   
</div>

  
          
       
             
        

@endsection
@section('js')

<script type="text/javascript">
    
    $(document).ready(function(){

    $('#title').on("keyup",function(){
   
     var url = $(this).val();

     $('#slug').val(url);


   });  
});   
  

$("#parent_id").select2({
    placeholder: "Select a category"
});
 

$("#cust_id").select2({
    placeholder: "Select a category"
});
 

</script>
<script type="text/javascript">
   
  function confrimDelete(id)
  {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-category-'+id).submit();
    }
 

  }
   
    function confrimDeleteOrder(id)
    {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-order-'+id).submit();
    }
 

    }

  function confrimDeleteProduct(id)
  {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-product-'+id).submit();
    }
 

  }

   function confrimDeleteAdmin(id)
  {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-admin-'+id).submit();
    }
 

  }

    function confrimDeleteUser(id)
  {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-user-'+id).submit();
    }
 

  }
</script>
<script type="text/javascript">
  
$(document).ready(function(){

 
 $('#country').change(function(){

  var id = $(this).val();

  if(id !==  0)
  {
      
      $.ajax({
      
      url:'{{route('state.index')}}',
      method:'GET',
      data:{id:id},
      success:function(data)
      {
        $('#state').html(data);
      }
     

      });


  }



 });

$('#state').change(function(){

  var id = $(this).val();

  if(id !==  0)
  {
     
      $.ajax({
      
      url:'{{route('city.index')}}',
      method:'GET',
      data:{id:id},
      success:function(data)
      {
        $('#city').html(data);
      }
     

      });
    

  }



 });


});



</script>

<script>


$(function(){
  CKEDITOR.replace( 'description' );
     
$('#btn-add').on('click', function(e){
  
    var count = $('.options').length+1;
    $.get("{{route('admin.extras')}}").done(function(data){
      
      $('#extras').append(data);
    });
});
$('#btn-remove').on('click', function(e){ 
  $('.options:last').remove();
})
$('#featured').on('change', function(){
  if($(this).is(":checked"))
    $(this).val(1)
  else
    $(this).val(0)
});
});
</script>


<script type="text/javascript">
   
  $('#select2').select2({
      placeholder: "Select category",
      allowClear: true
    });

    $('#status').select2({
      placeholder: "Select a status",
      allowClear: true,
    minimumResultsForSearch: Infinity
    });

    $('#thumbnail').on('change', function() {
    var file = $(this).get(0).files;
    var reader = new FileReader();
    
    reader.readAsDataURL(file[0]);
    reader.addEventListener("load", function(e) {
    var image = e.target.result;
    
    $("#imgthumbnail").attr('src', image);
    });
    });

</script>

 <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
 <script>
      feather.replace()
 </script>


@endsection