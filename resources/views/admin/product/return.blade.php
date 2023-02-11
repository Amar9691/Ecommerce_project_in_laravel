@isset($return)
<div class="container">
	<div class="table-responsive">
     <table class=" table table-striped table-hover table-bordered">
      
       <tr>
       	 <th>return Id</th>
       	 <th>order id</th>
       	 <th>User id</th>
       	 <th>User Email</th>
       	 <th>Reason </th>
       	 <th>request date</th>
       	 <th>return status</th>
       	 <th>Action</th>
       </tr>
       @foreach($return as $value)

       	<tr> <td>{{$value->id}}</td>
       	 <td>{{$value->orderid}}</td>
       	 <td>{{$value->user_id}}</td>
       	 <td>{{$value->user_email}}</td>
       	 <td>{{$value->issue}}</td>
       	 <td>{{$value->created_at}}</td>
       	 <td>{{$value->return_status}}</td>
       	 <td><a href="{{route('return.update.request',$value->id)}}" class="btn btn-sm btn-outline-dark">Update </a></td>
       </tr>
     
       @endforeach
     	 

     </table>

       @if($return->count() == 0)
            <div class="alert alert-danger">
              <strong>Not Record Found</strong>
            </div>
        @endif

     </div>
        <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $return->links()}}
           </center>
            
          </div>
          
        </div>




</div>
@endisset

@isset($returnupdate)


   <div class="jumbotron-fluid ">
    
      <form method="POST" action="{{ route('return.update', $returnupdate->id) }}" enctype="   multipart/form-data">

      
           @csrf
            <fieldset>
              <legend><b >Edit Return Request</b></legend>
            
               <div class="row">

            
               <div class="col-sm-12">
               <input type="hidden" name="user_id" value="{{$returnupdate->user_id}}">

               <input type="hidden" name="user_email" value="{{$returnupdate->user_email}}">

               <input type="hidden" name="orderid" value="{{$returnupdate->orderid}}">


               <input type="hidden" name="issue" value="{{$returnupdate->issue}}">
               <input type="hidden" name="created_at" value="{{$returnupdate->created_at}}">
             
               
             
               <div class="form-group">
               <label>Return status</label>
               
               <input type="text" name="return_status" class="form-control" value="{{$returnupdate->return_status}}">
                 
               </div>
             
            
                
                <input type="submit" name="submit" value="update" class="btn btn-outline-secondary">
                       



               </div>
                      
              </div>

             </fieldset>


         

       </form>
          
  
</div>

@endisset