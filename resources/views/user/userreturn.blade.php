@isset($yourreturn)
<div class="container">
    <div class="alert alert-info">
    	<strong>Your Return Orders</strong>
    </div>
	@foreach($yourreturn as $return)
   <div class="card">
      
    @foreach($userorder as $or)

    @if($or->id == $return->orderid)
      
    
        	<div class="card-header">
        	 <span class="text-secondary">Order ID:
      
           </span><strong class="text-primary ml-2"> {{$or->OrderID}}</strong>
      
     	    </div>
     	    
           <div class="card-body">
     
     	    
     			
     		   <ul style="list-style: none;">
            <li style="font-size: 12px;"><strong>Total items:</strong>&nbsp;{{$or->qty}}</li>
            <li style="font-size: 12px;"><strong>Total amount paid</strong>&nbsp;   Rs.{{$or->price}}/-</li>
              <li style="font-size: 12px;"><strong>Payment status:</strong>&nbsp;{{$or->paymentstatus}}</li>
              <li style="font-size: 12px;"><strong>Payment_id:</strong>&nbsp;{{$or->payment_id}}</li>
              <li style="font-size: 12px;"><strong>booked date:</strong>&nbsp;{{$or->created_at}}</li>
                <li style="font-size: 12px;"><strong>Your Order Delivered On:</strong>&nbsp;{{$or->delivery_at}}</li>
            </ul>

         </div>
    
    @endif
    @endforeach
      <div class="card-header">
        <ul style="list-style: none;">
          <li>Return request date {{$return->created_at}}</li>
          <li>Return status <span class="badge badge-info">{{$return->return_status}}</span></li>
        </ul>
        
      </div>

    </div>
      
  @endforeach
     		
              	
          <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $yourreturn->links()}}
           </center>
            
          </div>
          
        </div>

	   @if($yourreturn->count() == 0)
            <div class="alert alert-danger">
              <strong>You have not any return requested</strong>
            </div>
      @endif

	
</div>


@endisset