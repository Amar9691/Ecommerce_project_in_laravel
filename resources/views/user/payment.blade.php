@isset($userbill)
<div  class="container">

    

              @foreach($userbill as $bill)
               <div class="card">
               	<div class="card-header">
               		<ul style="list-style: none;">
               			<li>OrderId :{{$bill->OrderID}}</li>
               			<li>Amount Paid: Rs.{{$bill->price}}(inr)</li>
               			<li>Payment transition Id {{$bill->payment_id}}</li>
               			<li>Payment status {{$bill->paymentstatus}}</li>
               			<li>Payment date {{$bill->created_at}}</li>
               			
               		</ul>
               		
               	</div>
               	
               </div>

              @endforeach


              <div class="row justify-content-center">
              	<div class="col-sm-8">
              		{{ $userbill->links() }}
              		
              	</div>
              	
              </div>


              @if($userbill->count() == 0)

              <div class="alert alert-danger">
              	<strong>You have not done any payment</strong>
              	
              </div>

              @endif
              		



	
</div>
@endisset