@isset($usertrash)


<div class="container">
    <span class="float-left">Block User Information</span>
        


        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
               <th>id</th>
               <th>name</th>
               <th>Email Address</th>
               <th>Action</th>

              
            </tr>
          </thead>

      
        @foreach($usertrash as $user)
            <tbody>
            <tr>
             <td>{{ $user->id }}</td>
             <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                 <a href="{{ route('userrestore',$user->id) }}" class="btn btn-sm btn-info" >Unblock</a>|
                 <a href="{{ route('userremove',$user->id) }}" class="btn btn-sm btn-danger" >Paramently Delete</a>
             </td>
            
            


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
             @if($usertrash->count() ==0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif
      
  

</div>


@endisset



@isset($customer)


        <span class="float-left">Customer List Information</span>
        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
              <th>Customer id</th>
              <th>Profile Id</th>
              <th>name</th>
              <th>Email Address</th>
              <th>Mobile Number</th>
              <th>Address</th>
              <th>city_id</th>
              <th>state_id</th>
              <th>country_id</th>
              <th>Action</th>

              
            </tr>
          </thead>
      
        @foreach($customer as $user)
            <tbody>
            <tr>
             <td>{{ $user->id }}</td>
              <td>{{ $user->user_id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->slug }}</td>
              <td>{{$user->phone}}</td>
              <td>{{ $user->address}}</td>
              @if(isset($city))
              @foreach($city as $cty)
              @if($cty->id  == $user->city_id)
              <td>{{$cty->name}}</td>
              @endif
              @endforeach
              @endif
              <td>{{$user->state_id}}</td>
              <td>{{$user->country_id}}</td>
              <td>{{$user->phone}}</td>

              <td>
                
                
               <a href="javascript:;" onclick="confrimDeleteUser('{{$user->user_id}}')" class="btn btn-sm btn-danger">Block Admin</a>

                <form id="delete-user-{{$user->user_id}}" action="{{ route('profile.destroy',$user->user_id)}}" method="POST" style="display: none;">
                  @method('DELETE')
                  @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form>
            </td>
            
            


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>

          @if($customer->count() == 0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif

        </div>



@endisset

