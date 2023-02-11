@extends('layouts.app')
@section('maincss')

@endsection
@section('content')

<div class="container">
        @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
        @endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            
         
          @include('user.profile')
          @include('user.delete')
          @include('user.account')
          @include('user.order')
          @include('user.invoice')
          @include('user.userreturn')
          @include('user.payment')
       


        </div>
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
          
      document.getElementById('delete-user-'+id).submit();
    }
 

  }

 

</script>





<script type="text/javascript">
   
 

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

<script type="text/javascript">
  
$(document).ready(function(){

$('#country').change(function(){

    var id = $(this).val();

    if(id !== 0)
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

    if(id !== 0)
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

 <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
 <script>
      feather.replace()
 </script>


@endsection