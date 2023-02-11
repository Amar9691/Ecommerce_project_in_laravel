@isset($tempadmin)

<div class="container">
    <span class="float-left">Blocked Admin  Information</span>
        


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

      
        @foreach($tempadmin as $admin)
            <tbody>
            <tr>
             <td>{{ $admin->id }}</td>
             <td>{{ $admin->name }}</td>
              <td>{{ $admin->email }}</td>
              <td>
                 <a href="{{ route('adminrestore',$admin->id) }}" class="btn btn-sm btn-info" >Unblock</a>|
                 <a href="{{ route('adminremove',$admin->id) }}" class="btn btn-sm btn-danger" >Paramently Delete</a>
             </td>
            
            


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
             @if($tempadmin->count() ==0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif
      
  

</div>

@endisset

@isset($createadmin)
  
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-center text-white"><i class="fas fa-user"></i> {{ __('New Admin Registeration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin-register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



 @endisset

@isset($admins)


        <span class="float-left">Admins List Information</span>
        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
               <th>Profile id</th>
              <th>User Id</th>
              <th>name</th>
              <th>Email Address</th>
              <th>Mobile Number</th>
              <th>Action</th>

              
            </tr>
          </thead>
      
        @foreach($admins as $admin)
            <tbody>
            <tr>
             <td>{{ $admin->id }}</td>

              <td>{{ $admin->user_id }}</td>
              <td>{{ $admin->name }}</td>
               <td>{{ $admin->slug }}</td>
               <td>{{$admin->phone}}</td>

               <td>
                
                
               <a href="javascript:;" onclick="confrimDeleteAdmin('{{$admin->user_id}}')" class="btn btn-sm btn-danger">Block Admin</a>

                <form id="delete-admin-{{$admin->user_id}}" action="{{ route('adminpanel.destroy',$admin->user_id)}}" method="POST" style="display: none;">
                  @method('DELETE')
                  @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form></td>
            
            


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>

          @if($admins->count() == 0)
           <div class="alert alert-danger">
             <STRONG>Not Record Found</STRONG> 
           </div>

          @endif

        </div>















@endisset


@isset($profile)

<div class="jumbotron-fluid ">
    <form method="POST" action="{{ route('adminpanel.update',Auth::user()->id) }}" enctype="multipart/form-data">
        @method('PUT')
           @csrf
            <fieldset>
              <legend><center><i class="badge badge-primary ">Admin Profile</i></center></legend>


            
               <div class="row" >
                <div class="col-sm-1">
                    
                </div>

              <div class="col-sm-3">
                      
              <div class="form-group row">
                           
              <ul class="list-unstyled">
              <li style="color:black;">Profile Picture</li>

               <li >
            
              
               <div class="input-group ">
                    
                     <div class="img-thumbnail  text-center">
                     @if($profile->thumbnail !== NULL)
                     <img src= "{{asset('storage/'.$profile->thumbnail)}}" id="imgthumbnail" class="img-fluid" alt="">
                     @else
                     <img src= "{{asset('image/amarlinux.png')}}" id="imgthumbnail" class="img-fluid" alt="">
                     @endif
                     </div>
                     <div class="custom-file">
                     <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                     <label class="custom-file-label" for="thumbnail">Upload pic</label>
                     </div>
                     </div>
                     <input type="hidden" name="path" value="{{$profile->thumbnail}}">
                   
                
                </li>

                <li style="margin-top: 10px;">
                    
                    
                <center> 
                     <input type="submit" name="submit" value="update profile" class="btn btn-primary">
                  
                  </center>
                </li>
                            

                </ul>  
              </div>

                         

      </div>
                    
                    <div class="col-sm-1">
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="role" value="admin">

                        
                    </div>
                     
                        <div class="col-sm-5">
                      
                       <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  Auth::user()->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>


                           <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-10">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  Auth::user()->email}}" required autocomplete="name" autofocus>

                                @if(Auth::user()->email_verified_at== null)
                                 
                                  <span class="text-danger">  {{'please verify email' }}</span>
                                @else
                                 <span class="text-success">  {{'Verified' }}</span>


                                @endif


                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>


                           <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-10">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$profile->address}}"  autofocus>

                               


                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>


                           <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-10">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" p  autofocus placeholder="+91 722591XXXX" pattern="[0-9]{10}" min="6000000000" max="9999999999" value="{{$profile->phone}}">

                              
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                
                     
                      <ul class="list-unstyled">
                       <li>
                           <div class="form-group row">
                            <div class="col-sm-2">
                               <label for="country">Select Country</label>

                            </div>

                             <div class="col-sm-10">
                              <select id="country" name="country" class="custom-select"> 
                              
                          
                           @if($profile->country_id !== NULL)
                              
                           

                           @foreach($country as $cty)
                           <option value="{{$cty->id}}"  @if(!is_null($profile->country_id) && ($cty->id == $profile->country_id)) {{'selected'}} @endif > {{$cty->name}}</option>
                          
                           @endforeach
                        
                         




                           @else
                                  <option value="0" selected>select country</option>

                           @isset($country)

                           @foreach($country as $cty)

                              <option value="{{ $cty->id }}"> {{ $cty->name }}</option>

                           @endforeach
                          
                           @endisset

                              

                          @endif

                            
                              </select>
                            </div>
                               
                           </div>
                       </li>

                          <li>
                           <div class="form-group row">
                            <div class="col-sm-2">
                               <label for="country">Select State</label>

                                

                            </div>

                             <div class="col-sm-10">
                              <select id="state" name="state" class="custom-select"> 
                                
                               @if($profile->country_id !== NULL)
                               
                                    @if($profile->state_id !== NULL)
                                  
                                       @isset($state)
                                        
                                       @foreach($state as $st) 

                                       @if($st->country_id == $profile->country_id)          
                             
                                        <option value="{{$st->id}}" @if($st->id == $profile->state_id) {{ 'selected' }} @endif>{{$st->name}}</option>

                                       @endif

                                        @endforeach


                                        @endisset
                                
                        

                               

                               
                                  
                                 
                                    @else

                                           @isset($state)

                                           @foreach($state as $sty)

                                           @if($sty->country_id == $profile->country_id)

                                            <option value="{{$sty->id}}">{{$sty->name}}</option>

                                           @endif
                           
                                           @endforeach
 
                                           @endisset


                                    @endif
                             





                               @else

                                <option>select state</option>


                               @endif



                           
                              </select>
                            </div>
                               
                           </div>
                       </li>

                          <li>
                           <div class="form-group row">
                            <div class="col-sm-2">
                               <label for="country">Select City</label>

                            </div>

                             <div class="col-sm-10">
                              <select id="city" name="city" class="custom-select"> 
                                
                          @if($profile->country_id !== NULL)
                               
                               @if($profile->state_id !== NULL)
                                  
                                       @isset($city)
                                        
                                       @foreach($city as $st) 

                                       @if($st->state_id == $profile->state_id)          
                             
                                        <option value="{{$st->id}}" @if($st->id == $profile->city_id) {{ 'selected' }} @endif>{{$st->name}}</option>

                                       @endif

                                       @endforeach


                                       @endisset
                                
                        

                               

                               
                                  
                                 
                                @else
                                             <option>select city</option>
 


                                 @endif
                             





                        @else

                                <option>select city</option>


                        @endif



                              </select>
                            </div>
                               
                           </div>
                       </li>
                        </ul>


                         

                      </div>
                       

                         

                     
                     
                        
                            
                       
                      






             </fieldset>


         

       </form>
          
  
</div>





@endisset