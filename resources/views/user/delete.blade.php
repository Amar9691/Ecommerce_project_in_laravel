@isset($delete)


	<div class="row justify-content-center">
		<div class="col-md-6">
        
         <div class="card">
         	<div class="card-header">
         	<div class="alert alert-danger">
         		<strong>Please Read Carefully before Account delete</strong>
         	</div>
           
         	<strong>Parament Account Deletion Request</strong>
         	
         	</div>

         	<div class="card-body">
         	 Hello,  Dear {{$delete->name}}<br>
         	 You really want to close your account parament.<br>
         	 <span class="text-danger">
         	 Please remember once you delete account You can't recover it further.</span>
         	 <br>if you want to change your decision then go back
         	 <a href="{{url('/')}}" class="text-primary">Home</a>
         	  <br>Click below on given Link to delete Your Account
         	</div>
         	 

            <div class="card-footer">

             
            <a href="javascript:;" onclick="confrimDelete('{{$delete->user_id}}')" class="btn btn-sm btn-danger">Delete Account</a>

                <form id="delete-user-{{$delete->user_id}}" action="{{ route('userprofile.destroy',$delete->user_id)}}" method="POST" >
                  @method('DELETE')
                  @csrf
                 <input type="hidden" name="email" value="{{$delete->slug}}">

                 <label>Please Enter Your Password</label>
                 <input type="password" name="password" class="form-control">

                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form>
         		
         	</div>
         	

         </div> 
       

        

			
		</div>
		

	</div>


	



@endisset