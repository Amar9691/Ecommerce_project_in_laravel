@isset($order)


<div class="container">
    <span class="float-left">Orders Information</span>
        


        <div class="table-responsive-sm">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
               <th>id</th>
               <th>user_id</th>
               <th>product_id</th>
               <th>qty</th>
               <th>Payment Status</th>
               <th>delivery status</th>
               <th>price</th>
               <th>payment_id</th>
               <th>Booked date</th>
               <th>Delivery date</th>
               <th>Action</th>

              
            </tr>
          </thead>

      
        @foreach($order as $or)
            <tbody>
           
            
               <tr>
               <td>{{$or->id}}</td>
               <td>{{$or->user_id}}</td>
               <td>{{$or->product_id}}</td>
               <td>{{$or->qty}}</td>
               <td>{{$or->paymentstatus}}</td>
               <td>{{$or->status}}</td>
               <td>{{$or->price}}</td>
               <td>{{$or->payment_id}}</td>
               <td>{{$or->created_at}}</td>
               <td>{{$or->delivery_at}}</td>
               <td><a href="{{route('orders.edit',$or->id)}}" class="btn btn-sm btn-primary">EDIT</a>|
                 <a href="javascript:;" onclick="confrimDeleteOrder('{{$or->id}}')" class="btn btn-sm btn-danger">Delete</a>

               <form id="delete-order-{{$or->id}}" action="{{ route('orders.destroy',$or->id)}}" method="POST" style="display: none;">
                  @method('DELETE')
                  @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form></td>

             

              
            </tr>


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
        
        <div class="row">
          
          <div class="col-md-10">
          <center>
             {{ $order->links()}}
           </center>
            
          </div>
          
        </div>

             @if($order->count() ==0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif
      
  

</div>


@endisset



@isset($editorder)

 
   <div class="jumbotron-fluid ">
    
      <form method="POST" action="{{ route('orders.update', $editorder->id) }}" enctype="multipart/form-data">

        @method('PUT')
           @csrf
            <fieldset>
              <legend><b >Edit Order</b></legend>
            
               <div class="row">

                      <div class="col-sm-12">
               <input type="hidden" name="orderid" value="{{$editorder->OrderID}}">

               <input type="hidden" name="user_id" value="{{$editorder->user_id}}">
               <input type="hidden" name="product_id[]" value="{{$editorder->product_id}}">
               <input type="hidden" name="qty" value="{{$editorder->qty}}">
               <input type="hidden" name="paymentstatus" value="{{$editorder->paymentstatus}}">
               <input type="hidden" name="price" value="{{$editorder->price}}">
               <input type="hidden" name="payment_id" value="{{$editorder->payment_id}}">
               
               <div class="form-group">
                <label>Delivery status</label>
                <input type="text" name="status" class="form-control" value="{{$editorder->status}}">
                 
               </div>
                <div class="form-group">
                <label>Delivery Date</label>
                <input type="date" name="delivery_at" class="form-control" value="{{$editorder->delivery_at}}" required>
                 
                </div>
            
                
                <input type="submit" name="submit" value="update" class="btn btn-outline-secondary">
                       



               </div>
                      
              </div>

             </fieldset>


         

       </form>
          
  
</div>



   

@endisset

@isset($trashorder)

<div class="container">
    <span class="float-left">Cancels Orders Details</span>
        


        <div class="table-responsive-sm">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
               <th>id</th>
               <th>user_id</th>
               <th>product_id</th>
               <th>qty</th>
               <th>Payment Status</th>
               <th>delivery status</th>
               <th>price</th>
               <th>payment_id</th>
               <th>Booked date</th>
               <th>Delivery date</th>
               <th>Action</th>

              
            </tr>
          </thead>

      
        @foreach($trashorder as $or)
            <tbody>
           
            
               <tr>
               <td>{{$or->id}}</td>
               <td>{{$or->user_id}}</td>
               <td>{{$or->product_id}}</td>
               <td>{{$or->qty}}</td>
               <td>{{$or->paymentstatus}}</td>
               <td>{{$or->status}}</td>
               <td>{{$or->price}}</td>
               <td>{{$or->payment_id}}</td>
               <td>{{$or->created_at}}</td>
               <td>{{$or->delivery_at}}</td>
               <td>
                 <a href="{{route('porder',$or->id)}}" class="btn btn-outline-secondary btn-sm" >Remove</a>

              </td>

             

              
            </tr>


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
        
        <div class="row">
          
          <div class="col-md-10">
          <center>
             {{ $trashorder->links()}}
           </center>
            
          </div>
          
        </div>

             @if($trashorder->count() ==0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif
      
  

</div>


@endisset

@isset($bill)

<div class="container">
    <span class="float-left">Billing  Information</span>
        


        <div class="table-responsive-sm">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
               <th>id</th>
               <th>Billing Name</th>
               <th>Billing Email</th>
               <th>address1</th>
               <th>address2</th>
               <th>city</th>
               <th>state</th>
               <th>country</th>
               <th>Zip</th>
               <th>Shipping Name</th>
               <th>address1</th>
               <th>address2</th>
               <th>city</th>
               <th>state</th>
               <th>country</th>
               <th>Shipping Zip</th>
               <th>Received Date</th>
           

              
            </tr>
          </thead>

      
        @foreach($bill as $or)
            <tbody>
           
            
               <tr>
               <td>{{$or->id}}</td>
               <td>{{$or->billing_firstName}}</td>
               <td>{{$or->email}}</td>
               <td>{{$or->billing_address1}}</td>
               <td>{{$or->billing_address2}}</td>
               <td>{{$or->billing_city}}</td>
               <td>{{$or->billing_state}}</td>
               <td>{{$or->billing_country}}</td>
               <td>{{$or->billing_zip}}</td>
               <td>{{$or->shipping_firstName}}</td>
               <td>{{$or->shipping_address1}}</td>
               <td>{{$or->shipping_address2}}</td>
               <td>{{$or->shipping_city}}</td>
               <td>{{$or->shipping_state}}</td>
               <td>{{$or->shipping_country}}</td>
               <td>{{$or->shipping_zip }}</td>
               <td>{{$or->created_at}}</td>





             

              
            </tr>


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
        
        <div class="row">
          
          <div class="col-md-10">
          <center>
             {{ $bill->links()}}
           </center>
            
          </div>
          
        </div>

             @if($bill->count() ==0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif
      
  

</div>



@endisset