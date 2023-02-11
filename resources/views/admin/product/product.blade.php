@isset($editproduct)
  
   <div class="jumbotron-fluid ">
    
      <form method="POST" action="{{ route('products.update', $editproduct->id) }}" enctype="multipart/form-data">

        @method('PUT')
           @csrf
            <fieldset>
              <legend><b >Edit Product</b></legend>
            
               <div class="row">

                      <div class="col-sm-8">
                      
                       <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $editproduct->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>

                          <div class="form-group row">
                                 <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                                  

                                   <div class="col-md-10">
                                   <textarea id="description" name="description" class="form-control" cols="20" rows="2" required value="{{$editproduct->description}}" > {!! $editproduct->description!!}
                                  
                                   </textarea>

                                   @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                
                           </div>


                        <div class="form-group row">
                           <div class="col-4">
                           <label for="price">Price </label>
                           <div class="input-group">
                           <div class="input-group-prepend">
                             <button class="btn btn-sm btn-secondary">Rs.</button>
                           </div>
                           <input type="text" id="price" name="price" class="form-control" placeholder="XXXX /-" value="{{ $editproduct->price }}" required>

                           <div class="input-group-append">
                             <button class="btn btn-sm btn-secondary">INR</button>
                           </div>
                           </div>
                           
                            @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror

                           </div>


                           <div class="col-4">
                           <label for="discount">Discount </label>
                            <div class="input-group">
                            
                            <input type="text" class="form-control" id="discount" name="discount"  value="{{ $editproduct->discount }}" required />

                            <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary">%</button>
                            </div>
                            </div>
                            </div>


                           <div class="col-4">
                           <label for="stock">Stock </label>
                            <div class="input-group">
                            
                            <input type="text" id="stock" class="form-control" name="stock" placeholder="0000"   value="{{ $editproduct->stock }}" required>

                            <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary"> <span data-feather="folder-minus"></span>
                             </button>
                            </div>
                            </div>
                            </div>
                        </div>
                            
                       
                        <div class="form-group row">
                        <div class="card  col-sm-12">
                        <div class="card-header">
                        <h5 class="card-title float-left">Add Specification</h5>
                        <div class="float-right" >
                        <button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
                        <button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
                        </div>
          
                        </div>
                        <div class="card-body" id="extras">
 
                        </div>
                        </div>
                        </div>





                      </div>

                      <div class="col-sm-4">
                     
                       <ul class="list-group row">
                       <li class="list-group-item active"><span>Select Operation</span></li>
                       <li class="list-group-item">
                       <div class="form-group row">
                       <select class="form-control" id="status" name="status">

                       
                       <option value="0" @if(isset($editproduct) && $editproduct->status == 0){{ 'selected' }} @endif >Pending</option>
                       <option value="1" @if(isset($editproduct) && $editproduct->status == 1 ){{ 'selected' }} @endif >Publish</option>
                       </select>
                       </div>
                
                       </li>
                    
                     <li class="list-group-item active"><span>Feaured Image</span></li>
                     <li class="list-group-item">
                     <div class="input-group ">
                     <div class="custom-file">
                     <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                     <label class="custom-file-label" for="thumbnail">Choose file</label>
                     </div>
                     </div>
                    
                     <div class="img-thumbnail  text-center">
                    
                     <img src= "{{asset('storage/'.$editproduct->thumbnail)}}" id="imgthumbnail" class="img-fluid" alt="">
                       </div>
                       </li>
                       <li class="list-group-item">
                       <div class="col-12">
                       
                       <div class="input-group">
                      
                       <div class="input-group-prepend">
                       <span class="input-group-text" >


                        <input id="featured" type="checkbox" name="featured" value="@if(isset($editproduct)){{$editproduct->featured}} @else{{0}}  @endif" @if(isset($editproduct) && $editproduct->featured == 1) {{'checked'}} @endif /></span>
                       </div>

                       <p type="text" class="form-control" name="featured">Featured Product</p>
                       </div>
                       </div>
                       </li>

                     @php
                                  
                     $ids = (isset($editproduct->categories)  && $editproduct->categories->count() > 0) ?
                           
                              Arr::pluck($editproduct->categories->toArray() ,'id') : null 
                      
                      @endphp
     
                        <li class="list-group-item active"><span>Select Categories</span></li>
                        <li class="list-group-item ">
                        <select name="category_id[]" id="select2" class="form-control" multiple>
                        @if(isset($prd))
                        @foreach( $prd as $cate)
                        <option value="{{$cate->id}}"  @if(!is_null($ids) && in_array($cate->id, $ids)) {{'selected'}} @endif > {{$cate->title}}</option>
                        @endforeach
                        @endif
                       </select>
                       </li>
                     </ul>





       </div>
                       





         <div class="form-group row">
          <div class="col-lg-12">
           
          
            <input type="submit" name="submit" class="btn btn-primary btn-block " value="Update Product" />
         
          </div>
          
        </div>


               </div>


             </fieldset>


         

       </form>
          
  
</div>




@endisset











@isset($addProduct)

<div class="jumbotron-fluid ">
    
      <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
           @csrf
            <fieldset>
              <legend><b >Add New Product</b></legend>
            
               <div class="row">

                      <div class="col-sm-8">
                      
                       <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>

                          <div class="form-group row">
                                 <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                                  

                                   <div class="col-md-10">
                                   <textarea id="description" name="description" class="form-control" cols="20" rows="2" required>
                                  
                                   </textarea>

                                   @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                
                           </div>


                        <div class="form-group row">
                           <div class="col-4">
                           <label for="price">Price </label>
                           <div class="input-group">
                           <div class="input-group-prepend">
                             <button class="btn btn-sm btn-secondary">Rs.</button>
                           </div>
                           <input type="text" id="price" name="price" class="form-control" placeholder="XXXX /-" value="{{ old('price')}}" required>

                           <div class="input-group-append">
                             <button class="btn btn-sm btn-secondary">INR</button>
                           </div>
                           </div>
                           
                            @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror

                           </div>


                           <div class="col-4">
                           <label for="discount">Discount </label>
                            <div class="input-group">
                            
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="00"  value="00"  min="0" max="100" required/>

                            <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary">%</button>
                            </div>
                            </div>
                            </div>


                           <div class="col-4">
                           <label for="stock">Stock </label>
                            <div class="input-group">
                            
                            <input type="text" id="stock" class="form-control" name="stock" placeholder="0000"   value="{{ old('discount')}}" required>

                            <div class="input-group-append">
                            <button class="btn btn-sm btn-secondary"> <span data-feather="folder-minus"></span>
                             </button>
                            </div>
                            </div>
                            </div>
                        </div>
                            
                       
                        <div class="form-group row">
                        <div class="card  col-sm-12">
                        <div class="card-header">
                        <h5 class="card-title float-left">Add Specification</h5>
                        <div class="float-right" >
                        <button type="button" id="btn-add" class="btn btn-primary btn-sm">+</button>
                        <button type="button" id="btn-remove" class="btn btn-danger btn-sm">-</button>
                        </div>
          
                        </div>

                        <div class="card-body" id="extras">
 
                        </div>
                       

                        </div>
                        </div>





                      </div>

                      <div class="col-sm-4">
                     
                       <ul class="list-group row">
                       <li class="list-group-item active"><span>Select Operation</span></li>
                       <li class="list-group-item">
                       <div class="form-group row">
                       <select class="form-control" id="status" name="status">
                       <option value="0" >Pending</option>
                       <option value="1">Publish</option>
                       </select>
                       </div>
                
                       </li>
                    
                       <li class="list-group-item active"><span>Feaured Image</span></li>
                       <li class="list-group-item">
                    <div class="input-group ">
                    <div class="custom-file">
                    <input type="file"  class="custom-file-input" name="thumbnail" id="thumbnail">
                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                    </div>
                    </div>
                       <div class="img-thumbnail  text-center">
                       <img src="{{asset('image/android-chrome-192x192.png')}}"id="imgthumbnail" class="img-fluid" alt="">
                       </div>
                       </li>
                       <li class="list-group-item">
                       <div class="col-12">
                       
                       <div class="input-group">
                      
                       <div class="input-group-prepend">
                       <span class="input-group-text" ><input id="featured" type="checkbox" name="featured"/></span>
                       </div>
                       <p type="text" class="form-control" name="featured">Featured Product</p>
                       </div>
                       </div>
                       </li>
     
                        <li class="list-group-item active"><span>Select Categories</span></li>
                        <li class="list-group-item ">
                        <select name="category_id[]" id="select2" class="form-control" multiple>
                        @if(isset($procate))
                        @foreach( $procate as $cate)
                        <option value="{{$cate->id}}">{{$cate->title}}</option>
                        @endforeach
                        @endif
                       </select>
                       </li>
                     </ul>





       </div>
                       





         <div class="form-group row">
          <div class="col-lg-12">
           
          
            <input type="submit" name="submit" class="btn btn-primary btn-block " value="Add Product" />
         
          </div>
          
        </div>


               </div>


             </fieldset>


         

       </form>
          
  
</div>





@endisset




@isset($pro)
        <span class="float-left">Products Information</span>
        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
              <th>Id</th>
              <th>name</th>
              <th>price</th>
              <th>details </th>
              <th>stock</th>
              <th>discount</th>
              <th>discount_price</th>
              <th>Action</th>
              
            </tr>
          </thead>
      
        @foreach($pro as $product)
            <tbody>
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->title }}</td>
               <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
                 <td>{{ $product->stock}}</td>
                  <td>{{ $product->discount }}</td>
                   <td>{{ $product->discount_price }}</td>
                   <td> <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-primary">EDIT</a>|
                 <a href="javascript:;" onclick="confrimDeleteProduct('{{$product->id}}')" class="btn btn-sm btn-danger">Delete</a>

                <form id="delete-product-{{$product->id}}" action="{{ route('products.destroy',$product->id)}}" method="POST" style="display: none;">
                  @method('DELETE')
                  @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form></td>
            
            


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>

        @if($pro->count() == 0)
            <div class="alert alert-danger">
              <strong>Not Record Found</strong>
            </div>
        @endif

        </div>





 @endisset
  
@isset($stat)
         <div class="alert alert-danger text-center">
                <span style="font-size: 20px;">{{ $stat }}</span>
         </div>
@endisset

@isset($message)
         <div class="alert alert-danger text-center">
                <span style="font-size: 20px;">{{ $message }}</span>
         </div>
@endisset

@isset($temprod)

       

        <span class="float-left" style="font-size: 20px;"> Trashed Record (Temporary delete) </span>
       
         



        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
              <th>Id</th>
              <th>title</th>
              <th>description</th>
              <th>slug</th>
              <th>Categories</th>
               <th>Price</th>
               <th>Featured</th>
              <th>created_at</th>
              <th>Action</th>
              
            </tr>
          </thead>
      
        @foreach($temprod as $prod)
            <tbody>
            <tr>
              <td>{{ $prod->id }}</td>
              <td>{{ $prod->title }}</td>
              <td>{{ $prod->description }}</td>
              <td>{{ $prod->slug}}</td>
              <td>{{ $prod->category}}</td>
              <td>{{ $prod->price}}</td>
              <td>{{ $prod->featured}}</td>
              <td>{{ $prod->created_at }}</td>
              <td>
                 
                 <a href="{{ route('product.restore',$prod->id) }}" class="btn btn-sm btn-info" >Restore</a>|
                 <a href="{{ route('product.remove',$prod->id) }}" class="btn btn-sm btn-danger" >Paramently Delete</a>
                 
       
              </td>
           


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
                      


      </div>

        <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $temprod->links()}}
           </center>
            
          </div>
          
        </div>

 
       

 @endisset
