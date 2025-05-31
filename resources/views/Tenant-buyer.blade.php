@extends('layouts.app')
@section('title', 'Tenant-buyer')
@section('content')
@include('mainnav')<!-- include the nav file -->

<style>
  
    
    .filters {
        margin-top: 50px;    /* Reduced from 50PX */
        margin-bottom: 10px;
        margin-left: 4%;
    }
    .filters ul {
        display: flex;
        gap: 1rem; /* space between filter items */
        padding: 0;
        align-items: center;
    }
    
    .card{
        width: 100%;
        height: auto;
        border-radius: 4px;
      
    }
    .row{
        margin-left: 1%;
        margin-right: 1%;
        z-index: 1;
        
    }
    .card img{
        width: 100%;
        height: 200px;
        object-fit: cover;       /* Ensures the image covers the area and is not distorted */
        border-radius: 4px;
    }
    ul{
        list-style: none;

    }
  
</style>


<div class="filters ">
    <ul>
        <li><span class="bi bi-funnel-fill" style="font-size: 1.5rem; margin-right: 10px;color:green;"></span>
        </li>
        <li>
            <label for="">Location</label>
            <select class="custom-select" id="locationFilter">
            <option selected>---Location---</option>
            <option value="Nairobi">Nairobi</option>
            <option value="Nyeri">Nyeri</option>
            <option value="Embu">Embu</option>
            </select>
        </li>
        
         <li>
            <label for="">Type</label>
            <select class="custom-select" id="typeFilter">
            <option selected>-----Type-----</option>
            <option value="One-Bedroom">One-Bedroom</option>
            <option value="Single">Single</option>
            <option value="Bedsitter">Bedsitter</option>
            <option value="Shop-space">Shop-space</option>
            <option value="Apartment">Apartment</option>
            </select>
        </li>
    </ul>
</div>
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-4" role="alert" style="z-index: 9999; min-width: 250px;" id="autoFadeAlert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row">
    <h3><i class="bi bi-filter-right"></i>Available Spaces</h3>
     @forelse($houses as $house)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card" data-location="{{ $house->Location }}" data-type="{{ $house->Type }}">
                <img src="{{ asset('images/' . $house->image) }}" class="card-img-top" alt="House Image">
                <div class="card-body">
                    <h5 class="card-title"> {{ $house->Type ?? 'N/A' }}</h5>
                    <p class="card-text">
                        in {{ $house->Location ?? 'N/A' }}
                        For {{ $house->Rate ?? 'N/A' }}/month
                    </p>
                    <a href="{{url('House-view')}}" class="btn btn-warning">Details</a>
                </div>
            </div>
        </div>
    @empty
        <p>No houses found.</p>
    @endforelse
      
     
</div>      
<br><br>
@include('mainfooter')

@vite('resources/js/filters.js')<!-- javascript for filters -->
<script>
        setTimeout(function() {
            var alert = document.getElementById('autoFadeAlert');
            if(alert){
                alert.classList.remove('show');
                alert.classList.add('hide');
            }
        }, 2000); // 4000ms = 4 seconds
</script>
@endsection