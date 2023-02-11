@isset($order)
<div class="container">
    <div class="alert alert-info">
    	<strong>Your Orders</strong>
    </div>
	@foreach($order as $or)
     
     <div class="card">
     	<div class="card-header">
     	 <span class="text-secondary">Order ID:</span><strong class="text-primary ml-2">{{$or->OrderID}}</strong>
     	</div>
     	<div class="card-body">
     	<div class="row">
     		<div class="col-md-6">
     			
     			 @foreach($product as $pro)
     	         @if($pro->id == $or->product_id)
     	         <div class="row">
     	         <div class="col-md-2">
     	     
                 <img src="{{ asset('storage/'.$pro->thumbnail) }}"  width="100" height="100" alt="can't display">
          
                  </div>
                 
               	<div class="col-sm-5">
     			 <ul style="list-style: none;">
     				<li style="font-size: 12px;"><strong>Name:</strong> &nbsp;{{$pro->title}}</li>
     				<li style="font-size: 12px;"><strong>description:</strong><p>{!!$pro->description!!}</p></li>

     			 </ul>
         	     </div>

     	         <div class="col-sm-5">
     	    	<ul style="list-style: none;">
     				<li style="font-size: 12px;"><strong>Price:</strong>&nbsp;Rs.{{$pro->price}}/-</li>
     				<li style="font-size: 12px;"><strong>discount:</strong>&nbsp;{{$pro->discount}}%</li>
     			    <li style="font-size: 12px;"><strong>Paid Amount:</strong>&nbsp;Rs.{{$pro->discount_price}}/-</li>


     			</ul></div></div>
     			  @endif
            @endforeach


     		</div>

     		<div class="col-md-6">
               
              <div class="row">
              	<div class="col-md-6">
              	 	<ul style="list-style: none;">
     				<li style="font-size: 12px;"><strong>Total items:</strong>&nbsp;{{$or->qty}}</li>
     				<li style="font-size: 12px;"><strong>Total amount paid</strong>&nbsp;Rs.{{$or->price}}/-</li>
     			    <li style="font-size: 12px;"><strong>Payment status:</strong>&nbsp;{{$or->paymentstatus}}</li>
     			    <li style="font-size: 12px;"><strong>Payment_id:</strong>&nbsp;{{$or->payment_id}}</li>


     			</ul>
              		
              	</div>
              	<div class="col-md-6">

              		<ul style="list-style: none;">
     				<li style="font-size: 12px;"><strong>Book date:</strong>&nbsp;{{$or->created_at}}</li>

                    <li style="font-size: 12px;"><strong>delivery status:</strong>&nbsp;@if($or->status == 0)
                    <span class="text-danger">{{ 'Your Order is on the way' }}
                    excepted delivery date {{$or->delivery_at}}</span>
                      
                    <li>
                    <a href="javascript:;" onclick="confrimDeleteOrder('{{$or->id}}')" class="btn btn-outline-dark">Cancel Order</a>

                    <form id="delete-order-{{$or->id}}" action="{{ route('userorders.destroy',$or->id)}}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                   </form>
                    </li>
            


                    @else
                    <span class="text-success">{{ 'Product successfully Delivered To You' }} on {{$or->delivery_at}}</span>
                        

                    @if(date_add(date_create($or->delivery_at),date_interval_create_from_date_string("7 days")) > now() && $or->re == null)

                    <a href="{{route('userorders.show',$or->id)}}" class="btn btn-outline-dark">return request</a>

                    @endif

                    @if(date_add(date_create($or->delivery_at),date_interval_create_from_date_string("7 days")) > now() && $or->re == 1)

                    <button class="btn btn-outline-dark btn-block">return in processing</button>

                    @endif
                   

                    @endif
                    </li>
                    <li><a href="{{ route('invoice',$or->id) }}" class="btn btn-outline-dark btn-block">Download Invoice</a></li>
               


     			</ul>
              		
              	</div>

              	
              </div>


     			
     		</div>
     	</div>
       </div>
     	

     	
     
     
     	<div class="card-footer">
     		
     	</div>
     </div>
	  
	@endforeach


      <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $order->links()}}
           </center>
            
          </div>
          
        </div>

	   @if($order->count() == 0)
            <div class="alert alert-danger">
              <strong>We are still wait for Your First Order</strong>
            </div>
        @endif

	
</div>

<script type="text/javascript">
      function confrimDeleteOrder(id)
    {

    let choice = confirm('Are You Sure , What are you doing ?')

    if(choice)
    {
          
      document.getElementById('delete-order-'+id).submit();
    }
 

    }

  
</script>
@endisset