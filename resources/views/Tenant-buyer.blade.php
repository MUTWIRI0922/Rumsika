@extends('layouts.app')
@section('title', 'Tenant-buyer')
@section('content')
<!-- include the nav file -->
@include('mainnav')
<style>
  
    
    .filters {
     margin-top: 35px;    /* Reduced from 50PX */
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
        width: 23%;
        height: auto;
        border-radius: 4px;
        margin-right: 1%;
        margin-top: 2%;
    }
    .row{
        margin-left: 2%;
        width: 100%;
        top: -10;
        
    }
    .card img{
        width: 100%;
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
            <select class="custom-select" id="inputGroupSelect02">
            <option selected>---Location---</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            </select>
        </li>
        
         <li>
            <label for="">Type</label>
            <select class="custom-select" id="inputGroupSelect02">
            <option selected>---Type---</option>
            <option value="1">One-Bedroom</option>
            <option value="2">Single</option>
            <option value="3">Bedsitter</option>
            <option value="4">Shop-space</option>
            <option value="5">Two Bedroom</option>
            </select>
        </li>
    </ul>
</div>

<div class="row col-lg-6 col-md-6 col-xs-3 ">
    <h3><i class="bi bi-filter-right"></i>Available Spaces</h3>
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
<script>
    
</script>
@endsection