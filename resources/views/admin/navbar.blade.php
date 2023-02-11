 <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3" style="margin-top: -70px;">
      <ul class="nav flex-column">

           
      <li class="nav-item">
      <a class=" nav-link  @if( request()->url() == route('adminprofile')){{'active'}} @endif"   
         href="{{ route('adminprofile')}}">
      <div class="alert alert-info">
      <strong >Your Profile </strong>
      </div>
      <span class="sr-only">(current)</span>
      </a>

     </li>




      <li class="nav-item">
         <div class="dropdown show">
          <a class=" nav-link  @if( request()->url() == route('adminpanel.index')){{'active'}}  @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  href="{{ route('adminpanel.index')}}">
         <span data-feather="home"></span>
          Admin Section
          </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('adminpanel.index')}}">Admin List</a>
            <a class="dropdown-item" href="{{ route('adminpanel.create') }}">Add New Admin</a>
            <a class="dropdown-item" href="{{ route('admintemp')}}">Trashed Record</a>
            </div>
           </div>

       </li>

         <li class="nav-item">
         <div class="dropdown show">
          <a class=" nav-link  @if( request()->url() == route('profile.index')){{'active'}}  @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  href="{{ route('profile.index')}}">
         <span data-feather="bar-chart-2"></span>
          Customer Section
          </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('profile.index')}}">Customers record</a>
            <a class="dropdown-item" href="{{route('usertrash')}}">Trashed Record</a>
            </div>
           </div>

       </li>
          
       
         
       <li class="nav-item">

            <div class="dropdown show">
             <a class=" nav-link  @if( request()->url() == route('categories.index')){{'active'}} @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span data-feather="folder-minus"></span>

              Categories section
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('categories.index')}}">View Categories</a>
            <a class="dropdown-item" href="{{ route('addcate') }}">Add Category</a>
            <a class="dropdown-item" href="{{ route('tempcate')}}">Trashed Record</a>
            </div>
            </div>


           
          </li>
         





       

          <li class="nav-item">
              <div class="dropdown show">
             <a class=" nav-link  @if( request()->url() == route('products.index')){{'active'}} @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span data-feather="shopping-cart"></span>

               Products Section
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('products.index')}}">View Products</a>
               <a class="dropdown-item" href="{{ route('addProduct') }}">Add Product</a>
            <a class="dropdown-item" href="{{route('tempproduct') }}">Trashed Record</a>
            </div>
           </div>
             
          </li>
        
          <li class="nav-item">
              <div class="dropdown show">
             <a class=" nav-link  @if( request()->url() == route('orders.index')){{'active'}} @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span data-feather="layers"></span>


              Orders Section

            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('orders.index')}}">View Orders</a>
            <a class="dropdown-item" href="{{ route('ordertrash')}}">Trashed Record</a>
            <a class="dropdown-item" href="{{ route('orderreturn')}}">Return Request</a>
            </div>
           </div>
              
            
          </li>

           <li class="nav-item">
              <div class="dropdown show">
             <a class=" nav-link  @if( request()->url() == route('bill')){{'active'}} @endif dropdown-toggle "   id="dropdownMenuLink"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span data-feather="bar-chart-2"></span>


              Billing Section

            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{route('bill')}}">Billing details </a>
            
            </div>
           </div>
              
            
          </li>

          
          
        </ul>

    
     
      </div>
    </nav>