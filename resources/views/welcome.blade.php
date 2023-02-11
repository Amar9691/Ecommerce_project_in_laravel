@extends('layouts.app')
@section('content')
<div class="container">
  
       @if(session('message'))
           <center>  <div class="alert alert-success alert-dismissable "> 
              <span>{{ session('message') }}</span> <button class="close" data-dismiss="alert">&times;</button>
            </div>
          </center>
        @endif

 
        @include('main.main')      
            


 </div>
@include('user.footer')
@endsection
@section('js')
         
@endsection