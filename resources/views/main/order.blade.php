@extends('layouts.app')
@section('content')
<div class="container">
      @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
       @endif
 
      

       <div class="jumbotron shadow" id="reciept">

       	<div class="alert alert-success">
       		<span><strong class="text-center"> 	
     
       	 Your Order has been successfully Placed</strong></span>

       	</div>
                	<div >
                		<i>product details</i>
       	              <ul style="list-style: none;">
                              @foreach($pro as $product)
                              <li>Product Name   :{{$product->title}}</li>
                              <li>Product description:{!!$product->description!!}</li>
                               <li>Product Price  : Rs.{{$product->price}}/- INR</li>
                               @endforeach
                       </ul>
                  	</div>



       	<div class="card">
             
     
       		<div class="card-header">
       			<strong class="text-center">Your Order Detail</strong>
            
            </div>
     
          
       		<div class="card-body">
       			   
       			          
       		    <div class="row">
       		    	<div class="col-sm-5">
       		    		<span>Order details</span>


       		    		<ul style="list-style: none;">

                       
      
       		    		   @isset($order)
       		    			<li>Order ID: <strong class="text-secondary">{{$order->OrderID}}</strong></li>
       		    			<li>item Qunanity: <strong>{{$order->qty}}</strong></li>
       		    			<li>Payment status: <strong>{{$order->paymentstatus}}</strong></li>
       		    			<li>Order Amount: <strong>Rs.{{$order->price}}(INR)</strong></li>
       		    			<li>Payment ID: <strong>{{$order->payment_id}}</strong></li>
       		    			<li>Order Date: <strong>{{$order->created_at}}</strong></li>
       		    			<li>Order Delivery Date (excepted): <strong>  {{ date_add(now(),date_interval_create_from_date_string("7 days")) }}</strong></li>
       		    			@endisset
       		             
                    
       		    	   

       		    	
 

       		    		
       		    		</ul>
       		    		
       		    	</div>
       		    	<div class="col-sm-4">
                              <span>billing details</span>

       		    	
       		    			@isset($customer)
       		    			<p>
       		    			<strong>{{$customer->billing_firstName}}</strong>,
       		    		    <strong>{{$customer->email}}</strong>,
       		    			<strong>{{$customer->billing_address1}},{{$customer->billing_address2}},{{$customer->billing_city}},{{$customer->billing_state}},{{$customer->billing_country}},{{$customer->billing_zip}}</strong>
       		    		    </p>
                            @endisset
       		    	
       		    	</div>
       		    	<div class="col-sm-3">
       		    	    <span>Shipping details</span>

       		    	
                         
                        @isset($customer)
       		    		 <strong>{{$customer->billing_firstName}}</strong>,
       		    		 <strong>{{$customer->email}}</strong>,
       		    		 <strong>{{$customer->shipping_address1}},{{$customer->shipping_address2}},{{$customer->shipping_city}},{{$customer->shipping_state}},{{$customer->shipping_country}},{{$customer->shipping_zip}}</strong>,
       		    		  Phone Number: <strong>{{Auth::user()->profile->phone}}</strong>
                         @endisset

       		    		
       		    		
       		    		
       		    	</div>
       		    	
       		    </div>

       		</div>
       		
       	
       	</div>
       	
   
       
       </div>
       <div id="editor">
       	
       </div>

       	<div class="card-footer">
       	
       	  <a href="{{$url}}" class="btn btn-outline-success" downloa>Download Payment reciept</a>

       	  <button id="sub" class="btn btn-outline-secondary">Download Order Invoice Pdf </button>

       			
       </div>

       		





	
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<script type="text/javascript">
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#sub').click(function () {
    doc.fromHTML($('#reciept').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});

</script>
@endsection