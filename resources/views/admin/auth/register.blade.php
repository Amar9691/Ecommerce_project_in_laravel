@extends('admin.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-center text-white"><i class="fas fa-user"></i> {{ __('Important Alert Message') }}</div>

                <div class="card-body">
                   
                   <div class="alert alert-primary text-center ">

                    <strong>You Are Not A Right Page Please Click Below Given links To Access Our Service</strong>

                       
                   </div>

                      
                </div>
                <div class="card-footer">

                    <div class="alert alert-primary text-center ">

                   

                     <a href="{{ Url('/') }}" class="btn btn-danger">Vist Main Home Page Of Website</a>
                       
                   </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
