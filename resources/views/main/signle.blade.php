@extends('layouts.app')
@section('maincss')

@endsection
@section('content')

<div class="container">
        @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
        @endif

   
 <div class="album py-5 bg-light">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class=" mb-4">
        <div class="row">
          <div class="col-md-4">
            <img class="img-thumbnail" src="{{ asset('storage/'. $product->thumbnail)}}">
          </div>
          <div class="col-md-8">        
         
        <span   style="font-size: 20px;"> Product Name: </span>&nbsp;{{ $product->title }}<br>
         <span   style="font-size: 20px;"> Product Specification: </span>&nbsp;<br>
            <p class="card-text">{!! $product->description  !!}</p>

        <span class="" style="font-size: 20px;">Availablity status: &nbsp;</span>
        @if($product->stock == 0)
           {{ 'Currently Out of Stock' }}

        @else
              <strong>In stock</strong>
              <span class="badge badge-danger">{{$product->stock}} only left</span>

              <div class="d-block justify-content-between align-items-center">

             
                <a type="button" href="{{ route('card.add',$product->id) }}" class="btn btn-sm btn-outline-secondary">Add to Cart</a>
                <a type="button" class="btn btn-sm btn-primary">Buy Now</a>

           
            </div>


        @endif
          
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>


 
</div>
@endsection
