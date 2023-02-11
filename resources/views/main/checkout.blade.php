@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
   
       <div class="col-sm-3">
           <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">total items:{{$cart->getTotalQty()}}</span>
          </h4>
            
            <ul class="list-group mb-3">
            @foreach($cart->getContents() as $slug => $product)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{$product['product']->title}}</h6>
                <small class="text-muted">item: {{$product['qty']}}</small>
              </div>
              <span class="text-muted">Rs.{{$product['price']}}</span>
            </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <span>Total Payable Amount: &nbsp; Rs.{{$cart->getTotalPrice()}}</span>
            </li>
          </ul>
         
       </div>

       <div class="col-sm-9">
        <form action="{{route('pay')}}" method="POST" id="payment-form">
        @csrf
        <div class="row">
          <div class="col-sm-6">
         <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Billing and Shipping details</span>
          </h4>
           <div class="row">
             <div class="col-sm-6">
              <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" required>
              </div>
              <div class="form-group">
                <label>Mobile No.</label>
                <input type="text" name="mobile" class="form-control" value="{{Auth::user()->profile->phone}}" required>
              </div>

              <div class="form-group">
                <label>Billing address</label>
                <input type="text" name="ad1" id="ad1" class="form-control" placeholder="Address 1">
                <input type="text" name="ad2" id="ad2" class="form-control" placeholder="Address 2">
                <input type="text" name="ad3" id="ad3" class="form-control" placeholder="Address 3">
                <input type="text" name="ad4" id="ad4" class="form-control" placeholder="Village or Town">
                <input type="text" name="ad5" id="ad5" class="form-control" placeholder="City">
                <input type="text" name="ad6" id="ad6" class="form-control" placeholder="State">
                <input type="text" name="ad7" id="ad7" class="form-control" placeholder="Country">


                
              </div>
               <div class="form-group">
                   <input type="checkbox" name="same" id="same"> &nbsp;<span>same as billing address</span>

              </div>

               
             </div>
             <div class="col-sm-6">
               <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required>
              </div>
               <div class="form-group">
                <label>Pin code.</label>
                <input type="text" name="pin" class="form-control" required pattern="[0-9]{6}" placeholder="Ex. 475001">
              </div>

              <div class="form-group">
                <label>Shipping address</label>
                <input type="text" name="sh1" id="sh1" class="form-control" placeholder="Address 1">
                <input type="text" name="sh2" id="sh2" class="form-control" placeholder="Address 2">
                <input type="text" name="sh3" id="sh3" class="form-control" placeholder="Address 3">
                <input type="text" name="sh4" id="sh4" class="form-control" placeholder="Village or Town">
                <input type="text" name="sh5" id="sh5" class="form-control" placeholder="City">
                <input type="text" name="sh6" id="sh6" class="form-control" placeholder="State">
                <input type="text" name="sh7" id="sh7" class="form-control" placeholder="Country">

                <input type="hidden" name="price" value="{{$cart->getTotalPrice()}}">
                <input type="hidden" name="qty" value="{{$cart->getTotalQty()}}">
                 @foreach($cart->getContents() as $slug => $product)
                 
                 <input type="hidden" name="product_id[]" value="{{ $product['product']->id }}">
                
                 @endforeach
                
              </div>
               
             </div>
             
           </div>


            
          </div>

          <div class="col-sm-6">

            <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Complete Payment to place order</span>
            </h4>
                      <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                               Card Holder Name


                            </label>
                            <input type="text" name="card-holder-name" class="form-control" placeholder="Name As on Card">
                         </div>
                      
                     
                        </div>


                      <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                                Enter your credit card information
                            </label>
                         </div>
                      
                        <div class="card-body">
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                       </div>
                        </div>
                        <div class="card-footer">
                        <button class="btn btn-dark" type="submit">Place your order</button>
                        </div>
            
          </div>
          
        </div>
         </form>
       </div>

  
</div>
</div>





@endsection
@section('js')

<script type="text/javascript">
   
var stripe = Stripe('{{env("STRIPE_KEY")}}');
var elements = stripe.elements();
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

var card = elements.create('card', {style: style});

card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
        stripeTokenHandler(result.token);
    }
  });
});

function stripeTokenHandler(token) {
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  form.submit();
}


</script>
<script type="text/javascript">
  
$(document).ready(function(){

$('#same').click(function(){

     var ad1 = $('#ad1').val();
     var ad2 = $('#ad2').val();
     var ad3 = $('#ad3').val();
     var ad4 = $('#ad4').val();
     var ad5 = $('#ad5').val();
     var ad6 = $('#ad6').val();
     var ad7 = $('#ad7').val();
  
   if($(this).is(':checked'))
   {

       
       $('#sh1').val(ad1);
       $('#sh2').val(ad2);

       $('#sh3').val(ad3);
       $('#sh4').val(ad4);
       $('#sh5').val(ad5);
       $('#sh6').val(ad6);
       $('#sh7').val(ad7);

     

   }
   else
   {
        
       $('#sh1').val(null);
       $('#sh2').val(null);

       $('#sh3').val(null);
       $('#sh4').val(null);
       $('#sh5').val(null);
       $('#sh6').val(null);
       $('#sh7').val(null);


   }




});


});

</script>
@endsection
