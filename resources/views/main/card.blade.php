@extends('layouts.app')
@section('content')

     @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
      @endif

<div class="jumbotron" style="margin-top: -70px;">
	
<div class="alert alert-secondary w-25 text-center">
		<strong>Your Shopping Card</strong>
</div>

 @isset($cart)
<div class="alert alert-primary float-right w-25">
  		<span>Total items</span>: <strong  style="font-size: 15px;">
    
        {{ $cart->getTotalQty() }}</strong><br>
  		<span>Total Amount: </span><strong style="font-size:15px;">Rs.{{ $cart->getTotalPrice() }} /-</strong>

      <a href="{{route('order.checkout')}}" class=" btn btn-outline-dark mt-2">Place Order </a>

   


 </div>
 @endisset

@if(isset($cart) && $cart->getContents())


@foreach($cart->getContents() as $slug => $product)
<div class="row">
 <div class="col-md-3">
    <img src="{{ asset('storage/'.$product['product']->thumbnail) }}" class="img-thumbnail">
 	
 </div>
  <div class="col-md-5">
   <table >
   	<caption style="caption-side: top;">Product Description</caption>
   	<tr>
   		<th>Product Name</th>
   		<td>{{ $product['product']->title }}</td>
   		
   	</tr>
   	 	<tr>
   		<th>Product Description</th>
   		<td>{!! $product['product']->description !!}</td>
   		
   	</tr>
   	 	<tr>
   		<th>Product Price</th>
   		<td>Rs.{{ $product['product']->price }}/-(INR)</td>
   		
   	</tr>
   	 	<tr>
   		<th>Discount Offer</th>
   		<td>{{ $product['product']->discount }}%</td>
   		
   	</tr>
   	 	<tr>
   		<th>Total Amount To Pay</th>
   		<td>Rs.{{ $product['product']->discount_price }} /-(INR)</td>
   		
   	</tr>
   	
   </table>
 	
 </div>
  <div class="col-md-2">
 	
   <form method="POST" action="{{ route('card.update',$product['product']->id) }}">
   	@csrf
   	<div class="form-group">
   		<label>Total items</label>
   		<input type="number" name="qty" id="qty" class="form-control text-center" min="0" max="99" value="{{$product['qty']}}">
   		
   	</div>
   	<input type="submit" name="update" value="Edit item" class="btn btn-success btn-block">
   </form>
   <br>

   <form action="{{route('card.remove', $product['product']->id)}}" method="POST" accept-charset="utf-8">
  
    @csrf

	<input type="submit" name="remove" value="Remove Item" class="btn btn-danger btn-block"/>
   </form>
 	
 </div>
	
</div>

@endforeach

  
  
  	
  		

  		

 
  


@else

<div class="alert alert-dark w-25 text-center">
		<strong>Your Card is Empty</strong>

</div>
   
   <div class="w-25">
 <a href="{{ route('main')}}" style="text-decoration: none;" class="alert-link"><button class="btn btn-outline-dark btn-block">Look our best deals</button></a>
</div>


  


@endif


</div>

@endsection
