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
        height: auto;
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
    .card-img-top {
    width: 100%;
    height: 200px;         /* Adjust height as needed */
    object-fit: cover;     /* Ensures image covers area, cropping if needed */
    border-radius: 4px;
    }   
</style>
 <div class="row row-1  mt-5">
     @if(isset($select_house))
    <div class="col-md-5 d-flex justify-content-center ">
        <img src="{{ asset('storage/' . $select_house->image)}}" alt=" house image" srcset="" style="width: 100%; height: 400px;">
    </div>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-4" role="alert" style="z-index: 9999; min-width: 250px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Showing details of the selected house -->
   
            <div class="col-md-5  ">
            <h1>{{ $select_house->Type ?? 'House Name' }}</h1>
            <div class="row">
                <div class="col"><p><b>Posted by: {{ $select_house->landlord->name ?? 'Unknown' }}</b></p></div>
                <div class="col"><p><b>Tel: {{ $select_house->landlord->phone ?? 'N/A' }}</b></p></div>
            </div>
            <p>Description:{{ $select_house->Description ?? 'House Description' }}</p>
            <p>Rate: <b>{{ $select_house->Rate ?? 'N/A' }}</b></p>
            <p>Location: <b>{{ $select_house->Location ?? 'N/A' }}</b></p></p>
            <p>Type: <b>{{ $select_house->Type ?? 'N/A' }}</b></p>
            @php
                $phone = $select_house->landlord->phone ?? '';
                // If phone starts with 0, replace with 254
                if (Str::startsWith($phone, '0')) {
                    $phone = '254' . substr($phone, 1);
                }
            @endphp
            <a href="https://wa.me/{{$phone}}?text=Hello {{$select_house->landlord->name}},%20I%20am%20interested%20in%20your%20{{ urlencode($select_house->Type ?? 'house') }}%20at%20{{ urlencode($select_house->Location ?? '') }}.%20Could%20you%20please%20provide%20more%20details?"
                class="btn btn-warning"
                target="_blank">Contact Seller</a>
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
                    <img src="{{ asset('storage/' . $house->image)}}" class="card-img-top" style="max-width:px;" alt="House Image">
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