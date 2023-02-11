@isset($inorder)



           

              <div  class="container" id="reciept">
              	 <div class="alert alert-success">
       		<span><strong class="text-center"> 	
     
       	     Your Order has been successfully Placed</strong></span>

  	        </div>
  	          <span class="text-secondary"> OrderID: {{$inorder->OrderID}} &nbsp;</span> <span class="text-secondary">PaymentID: &nbsp;{{$inorder->payment_id}}</span>
  	        
                	<div class="row">
                		<div class="col-sm-4">
                		<i>product details</i>
       	                  <ul style="list-style: none;">
                              @foreach($pro as $product)
                              <li>Product Name   :{{$product->title}}</li>
                              <li>Product description:{!!$product->description!!}</li>
                               <li>Product Price  : Rs.{{$product->price}}/- INR</li>
                               @endforeach
                         </ul>
                		</div>
                		<div class="col-sm-4">
                		<i>billing details</i><br>
       	                 	<p>
       		    			<strong>{{$customer->billing_firstName}}</strong>,
       		    		    <strong>{{$customer->email}}</strong>,
       		    			<strong>{{$customer->billing_address1}},{{$customer->billing_address2}},{{$customer->billing_city}},{{$customer->billing_state}},{{$customer->billing_country}},{{$customer->billing_zip}}</strong>
       		    		    </p>
                		</div>
                		<div class="col-sm-4">
                		<i>shipping address</i><br>
       	                 <strong>{{$customer->billing_firstName}}</strong>,
       		    		 <strong>{{$customer->email}}</strong>,
       		    		 <strong>{{$customer->shipping_address1}},{{$customer->shipping_address2}},{{$customer->shipping_city}},{{$customer->shipping_state}},{{$customer->shipping_country}},{{$customer->shipping_zip}}</strong>,
       		    		  Phone Number: <strong>{{Auth::user()->profile->phone}}</strong>
                		</div>

                		
                      </div>
                      <div>
                     <span class="text-secondary"> Book date: {{$inorder->created_at}} &nbsp;</span> Delivery date: <span class="text-secondary">{{$inorder->delivery_at}}</span>
                      </div>
               </div>


               <div id="editor">
       	
               </div>

               <div class="card-footer">
       	
       	
       	  <button id="sub" class="btn btn-outline-secondary">Download Order Invoice Pdf </button>

       			
       </div>




	



















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

@endisset