@extends('layouts.app')
@section('title', 'Tenant-buyer')
@section('content')
<style>
  
    .navbar{
        box-shadow: 3px 3px 5px grey;
        width: 100%;
        position: fixed;
    }
    .navbar img{
        width: 60vw !important;
        max-width: 200px;
    }
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

<div class="nav pb-4">
    <nav>
        <div class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="{{ url('') }}" class="ml-4"><img class="img-fluid " style=" width:25%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"></a> 
           
        <form action="" class="flex-grow-1 d-flex mx-3" style="width:50%;">
            <input type="text" name="" id="" class="form-control me-2" placeholder="search">
            <button type="submit" class="btn btn-success">Search</button>
        </form>
        <span class="glyphicon glyphicon-search"></span>

        <a href="http://" style="padding-RIGHT: 10%; text-decoration:none;">Lease/sell</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
</div>
<div class="filters ">
    <ul>
        <li>    <span class="bi bi-funnel-fill" style="font-size: 1.5rem; margin-right: 10px;"></span>
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
            <h3>Available Spaces</h3>
            <div class="card ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="http://" class="btn btn-warning">Details</a>
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
            <div class="card  ">
                <img src="{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}" alt="house" srcset="">
                <p>Bungalow at Nyeri</p>
                <a href="http://" class="btn btn-warning">Details</a>
            </div> 
        </div>

@endsection