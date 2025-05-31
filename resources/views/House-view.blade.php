@extends('layouts.app')
@section('title', 'House View')
@section('content')
@include('mainnav')
<style>
    .row-1 {
        align-items: center;
        justify-content: center;
        display: flex;
    }
    .row-1 img {
        width: 100%;
        max-width: 600px;
        height: auto;
        border-radius: 4px;
       
    }
    .card{
        width: 23%;
        height: 200px;
        border-radius: 4px;
        margin-right: 1%;
        margin-top: 2%;
    }
    .row-2{
        margin-left: 2%;
        width: 100%;
        top: -10;
        
    }
    .card img{
        width: 100%;
    }
</style>
 <div class="row row-1  mt-5">
    <div class="col-md-5 d-flex justify-content-center ">
        <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="" srcset="">
    </div>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-4" role="alert" style="z-index: 9999; min-width: 250px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Showing details of the selected house -->
    @if(isset($select_house))
            <div class="col-md-5  ">
            <h1>{{ $select_house->Type ?? 'House Name' }}</h1>
            <div class="row">
                <div class="col"><p><b>Posted by:</b></p></div>
                <div class="col"><p><b>Tel:</b></p></div>
            </div>
            <p>Description:{{ $select_house->Description ?? 'House Description' }}</p>
            <p>Rate: {{ $select_house->Rate ?? 'N/A' }}</p>
            <p>Location: {{ $select_house->Location ?? 'N/A' }}</p></p>
            <p>Type: {{ $select_house->Type ?? 'N/A' }}</p>
            <button class="btn btn-primary">Contact Seller</button>
            <div class="row row-3">
                <div class="col">
                    <img src="" alt="outside">
                </div>
                <div class="col">
                    <img src="" alt="inside">
                </div>
                <div class="col">
                    <img src="" alt="amenities">
                </div>
            </div>
        </div>
    @endif
    
 </div>
 <br><br>
 <h3 style="margin-left: 5%; margin-bottom:0;"><i class="bi bi-filter-right"></i> Other Available spaces</h3>
<!-- Show available houses in a grid format -->
 <div class="row row-2 col-lg-6 col-md-6 col-xs-3 ">
         @forelse($houses as $house)
            
                <div class="card">
                    <img src="{{ asset('images/' . $house->image) }}" class="card-img-top" alt="House Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $house->Type ?? 'N/A' }}</h5>
                        <p class="card-text align-text-center">
                            in <b>{{ $house->Location ?? 'N/A' }}</b>
                            For <b>{{ $house->Rate ?? 'N/A' }}</b>
                        </p>
                        <a href="{{url('/House-view/' .$house->id )}}" class="btn btn-warning">Details</a>
                    </div>
                </div>
            
          @empty
            <p>No houses found.</p>
        @endforelse
        
</div>
     
<br><br>
@include('mainfooter')
@endsection