@isset($account)
<div class="jumbotron shadow">


	<div class="card-deck">
		<div class="card">
			<div class="card-header">
				<span class="fether-orders">Your Orders</span>
			</div>
			<div class="card-body">
				<p>See Your orders which you have made successfully.</p>
				<a href="{{route('userorders.index')}}" class="card-link">Go To Watch</a>
				
			</div>
			
		</div>
		<div class="card">
			<div class="card-header">
				
				<span class="fether-orders">Your Profile</span>
				

			</div>
			<div class="card-body">
			   <p>Looked at Your orders and Edit Email, Name, delivery address whatever you think</p>
				<a href="{{ route('userprofile.edit',Auth::user()->id) }}" class="card-link">Go To Profile</a>
				
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				
				<span class="fether-orders">Return Products</span>
				

			</div>
			<div class="card-body">
			   <p>See list of products which you have returned successfully and want to buy again.</p>
				<a href="{{ route('userreturn.index') }}" class="card-link">your Return</a>
				
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				
				<span class="fether-orders">Account Payment details</span>
				

			</div>
			<div class="card-body">
			   <p>See all the list of payments which you have made successfully on this platform</p>
				<a href="{{ route('userpayment.index')}}" class="card-link">Click To see Transition</a>
				
			</div>
		</div>
		
	</div>
	

</div>
@endisset