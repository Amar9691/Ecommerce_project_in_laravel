@isset($userprofile)

<div class="jumbotron-fluid ">
  <div class="alert alert-info">
    <strong>Your Profile</strong>
  </div>
    <form method="POST" action="{{ route('userprofile.update',Auth::user()->id) }}" enctype="multipart/form-data">
        @method('PUT')
           @csrf
            <fieldset>
              


            
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
                     @if($userprofile->thumbnail !== NULL)
                     <img src= "{{asset('storage/'.$userprofile->thumbnail)}}" id="imgthumbnail" class="img-fluid" alt="">
                     @else
                     <img src= "{{asset('image/amarlinux.png')}}" id="imgthumbnail" class="img-fluid" alt="">
                     @endif
                     </div>
                     <div class="custom-file">
                     <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                     <label class="custom-file-label" for="thumbnail">Upload pic</label>
                     </div>
                     </div>
                     <input type="hidden" name="path" value="{{$userprofile->thumbnail}}">
                   
                
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
                        <input type="hidden" name="role" value="user">

                        
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
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$userprofile->address}}"  autofocus>

                               


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
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" p  autofocus placeholder="+91 722591XXXX" pattern="[0-9]{10}" min="6000000000" max="9999999999" value="{{$userprofile->phone}}">

                              
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
                              
                          
                           @if($userprofile->country_id !== NULL)
                              
                           

                           @foreach($country as $cty)
                           <option value="{{$cty->id}}"  @if(!is_null($userprofile->country_id) && ($cty->id == $userprofile->country_id)) {{'selected'}} @endif > {{$cty->name}}</option>
                          
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
                                
                               @if($userprofile->country_id !== NULL)
                               
                                    @if($userprofile->state_id !== NULL)
                                  
                                       @isset($state)
                                        
                                       @foreach($state as $st) 

                                       @if($st->country_id == $userprofile->country_id)          
                             
                                        <option value="{{$st->id}}" @if($st->id == $userprofile->state_id) {{ 'selected' }} @endif>{{$st->name}}</option>

                                       @endif

                                        @endforeach


                                        @endisset
                                
                        

                               

                               
                                  
                                 
                                    @else

                                           @isset($state)

                                           @foreach($state as $sty)

                                           @if($sty->country_id == $userprofile->country_id)

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
                                
                          @if($userprofile->country_id !== NULL)
                               
                               @if($userprofile->state_id !== NULL)
                                  
                                       @isset($city)
                                        
                                       @foreach($city as $st) 

                                       @if($st->state_id == $userprofile->state_id)          
                             
                                        <option value="{{$st->id}}" @if($st->id == $userprofile->city_id) {{ 'selected' }} @endif>{{$st->name}}</option>

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