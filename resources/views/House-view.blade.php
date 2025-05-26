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
</style>
 <div class="row row-1  mt-5">
    <div class="col-md-5 d-flex justify-content-center ">
        <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="" srcset="">
    </div>

    <div class="col-md-5  ">
        <h1>House Name</h1>
        <div class="row">
            <div class="col"><p><b>Posted by:</b></p></div>
            <div class="col"><p><b>Tel:</b></p></div>
        </div>
        <p>House Description</p>
        <p>Price: $XXX,XXX</p>
        <p>Location: City, State</p>
        <p>Type: Bungalow</p>
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
 </div>
 <br><br>
 <h3 style="margin-left: 5%; margin-bottom:0;"><i class="bi bi-filter-right"></i> Other Available spaces</h3>
<div class="row row-2 col-lg-6 col-md-6 col-xs-3 ">
         @forelse($houses as $house)
            
                <div class="card">
                    <img src="{{ asset('images/' . $house->image) }}" class="card-img-top" alt="House Image">
                    <div class="card-body">
                        <h5 class="card-title">Type: {{ $house->Type ?? 'N/A' }}</h5>
                        <p class="card-text">
                            Location: {{ $house->Location ?? 'N/A' }}<br>
                            {{ $house->Description ?? 'No Title' }}
                            Price: {{ $house->Rate ?? 'N/A' }}
                        </p>
                        <a href="#" class="btn btn-warning">Details</a>
                    </div>
                </div>
            
          @empty
            <p>No houses found.</p>
        @endforelse
        <div class="card ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="{{ url('House-view') }}" class="btn btn-warning">Details</a>
        </div>
        <div class="card  ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="{{ url('House-view') }}" class="btn btn-warning">Details</a>
        </div> 
        <div class="card  ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="http://" class="btn btn-warning">Details</a>
        </div> 
        <div class="card  ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="http://" class="btn btn-warning">Details</a>
        </div> 
</div>
     
<br><br>
@include('mainfooter')
@endsection