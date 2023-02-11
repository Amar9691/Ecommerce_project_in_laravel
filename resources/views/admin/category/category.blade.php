 @isset($addcategory) 
<div class="jumbotron-fluid ">
    
      <form method="POST" action="{{ route('categories.store') }}" class="text-center w-75 ml-5">
                        @csrf
            <fieldset>
              <legend><b >Add New Category</b></legend>
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="slug"  id="slug">
                          <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('description') }}</label>

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

                         <div class="form-group row" >
                            <label for="parent_id" class="col-md-2 col-form-label text-md-right">{{ __('select category') }}</label>

                            <div class="col-md-10">

                           <select class="form-control" id="parent_id" name="parent_id[]" multiple="multiple" style="width:100% ">
                            
                                @isset($oldcate)
                                @foreach($oldcate as $category)
                                 <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                                @endisset
                       
                           </select>

                          

                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                   
                     

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Category') }}
                                </button>
                                <input type="reset" name="reset" value="reset" class="btn btn-danger">
                            </div>
                        </div>
                        </fieldset>
                    </form>
                      <script>
                        CKEDITOR.replace( 'description' );
                     </script>
  
</div>
@endisset

@isset($cat)
<div class="container mt-4 w-50">
           <div class="alert alert-info text-center">
               <strong class="text-center">Update Category</strong>
             
           </div>
           <form method="POST" action="{{ route('categories.update',$cat->id) }}" class="text-center">
            @method('PUT')
            @csrf

           <div class="form-group row">
           <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

           <div class="col-md-10">
           <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $cat->title }}" required autocomplete="title" autofocus>
           <input type="hidden" name="updateid" value="{{$cat->id}}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="slug"  id="slug" >
                          <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-10">
                                <textarea class="form-control" id="description" name="description" cols="20" rows="2" >
                                	{!! $cat->description !!}
                                </textarea>
                                  
                                

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row" >
                           

                          @php
                                  
                           $ids = (isset($cat->childrens)  && $cat->childrens->count() > 0) ?
                                  Arr::pluck($cat->childrens ,'id') : null 
                          @endphp


                            <label for="parent_id" class="col-md-2 col-form-label text-md-right">{{ __('Select Category') }}</label>

                            <div class="col-md-10">

                           <select class="form-control" id="cust_id" name="parent_id[]" multiple="multiple" style="width:100% ">
                            
                           @if(isset($cata))
                           
                           @foreach($cata as $category)
                           
                            <option value="{{ $category->id }}" @if(!is_null($ids) && in_array($category->id,$ids)) {{'selected'}} @endif > {{ $category->title }}</option>
                            
                            @endforeach
                          
                           @endif
                       
                           </select>

                          

                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                   
                     

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update ') }}
                                </button>
                                  <input type="reset" name="reset" value="Reset" class="btn btn-danger"> 
                            </div>
                        </div>
                    </form>
                  </div>

@endisset

@isset($cate)

       

        <span class="float-left"> Categories</span>
       
         



        <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
            <tr>
              <th>Id</th>
              <th>title</th>
              <th>description</th>
              <th>slug</th>
              <th>Categories</th>
              <th>created_at</th>
              <th>Action</th>
              
            </tr>
          </thead>
      
        @foreach($cate as $categories)
            <tbody>
            <tr>
              <td>{{ $categories->id }}</td>
              <td>{{ $categories->title }}</td>
              <td>{{ $categories->description }}</td>
              <td>{{ $categories->slug}}</td>
              <td>@if($categories->childrens()->count() > 0)
                    
                    @foreach($categories->childrens as $children)
                        {{$children->title}},
                    @endforeach
                  @else
                      <strong>{{__('parent')}}</strong>
                  @endif
              </td>

              <td>{{ $categories->created_at }}</td>
              <td>
                 <a href="{{route('categories.edit',$categories->id)}}" class="btn btn-sm btn-primary">EDIT</a>|
                 <a href="javascript:;" onclick="confrimDelete('{{$categories->id}}')" class="btn btn-sm btn-danger">Delete</a>

                <form id="delete-category-{{$categories->id}}" action="{{ route('categories.destroy',$categories->id)}}" method="POST" style="display: none;">
                  @method('DELETE')
                  @csrf
                <!--  <input type="submit" name="submit" value="DELETE" onclick="confrimDelete()" class="btn btn-sm btn-danger">-->
                  
                </form>

       
              </td>
           


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
         
         @if($cate->count() == 0)
         <div class="alert alert-danger">
         	<strong>No Record Found</strong>
         </div>

         @endif   


      </div>

        <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $cate->links()}}
           </center>
            
          </div>
          
        </div>

    
       

 @endisset


 @isset($tempcate)

       

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
              <th>created_at</th>
              <th>Action</th>
              
            </tr>
          </thead>
      
        @foreach($tempcate as $categories)
            <tbody>
            <tr>
              <td>{{ $categories->id }}</td>
              <td>{{ $categories->title }}</td>
              <td>{{ $categories->description }}</td>
              <td>{{ $categories->slug}}</td>
              <td>@if($categories->childrens()->count() > 0)
                    
                    @foreach($categories->childrens as $children)
                        {{$children->title}},
                    @endforeach
                  @else
                      <strong>{{__('parent')}}</strong>
                  @endif
              </td>

              <td>{{ $categories->created_at }}</td>
              <td>
                 
                 <a href="{{ route('category.restore',$categories->id) }}" class="btn btn-sm btn-info" >Restore</a>|
                 <a href="{{ route('category.remove',$categories->id) }}" class="btn btn-sm btn-danger" >Paramently Delete</a>
                 
       
              </td>
           


              
            </tr>
           
          
          </tbody>
        

        @endforeach
        </table>
                      
           
         @if($tempcate->count() == 0)
         <div class="alert alert-danger">
         	<strong>No Record Found</strong>
         </div>

         @endif   

      </div>

        <div class="row">
          
          <div class="col-md-12">
          <center>
             {{ $tempcate->links()}}
           </center>
            
          </div>
          
        </div>

 
       

 @endisset

