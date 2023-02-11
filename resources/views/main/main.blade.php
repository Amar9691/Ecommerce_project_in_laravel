<!--<div id="slider" class="carousel slide" data-ride="carousel">

 
  <ul class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"></li>
    <li data-target="#slider" data-slide-to="2"></li>
    <li data-target="#slider" data-slide-to="3"></li>
  </ul>


  <div class="carousel-inner" style="height: 550px;">
    <div class="carousel-item active">
      <img src="{{ asset('image/3.jpg')}}" alt="slider3"  width="1200" >
       <div class="carousel-caption">
        
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('image/4.jpg')}}" alt="slider4"  width="1200">
       <div class="carousel-caption">
        
        
      </div>
    </div>
    <div class="carousel-item ">


      <img src="{{ asset('image/1.jpg')}}" alt="slider1"  width="1200">
      <div class="carousel-caption">
        
        
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('image/7.jpg')}}" alt="slider2"  width="1200">
       <div class="carousel-caption">
        
        
      </div>
    </div>
    
  </div>


   <a class="carousel-control-prev" href="#slider" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
   </a>
   <a class="carousel-control-next" href="#slider" data-slide="next">
    <span class="carousel-control-next-icon"></span>
   </a>

</div>-->


<main role="main">

    
   

    
  <div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
     
      @foreach($products as $product)
      <div class="col-md-4">
      

        <div class="card mb-4 shadow-sm" style="height: 650px;">
          <img class="card-img-top img-thumbnail" src="{{ asset('storage/'. $product->thumbnail)}}" > 
          <div class="card-body">
            <h4 class="card-title">{{ $product->title }}</h4>
            <p class="card-text">{!! substr($product->description,0, 30 ) !!}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
             <a type="button" class="btn btn-sm  btn-primary" href="{{ route('single',$product->id) }}"> View Product</a>
             <a type="button" href="{{ route('card.add',$product->id) }}" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
              </div>
           
            </div>
          </div>
        </div>
      
      </div>
      @endforeach
    
       </div>
      <div class="row">
        <div class="col-md-12">
          {{ $products->links() }}
        </div>
      </div>
  </div>
</div>

 </main>

 