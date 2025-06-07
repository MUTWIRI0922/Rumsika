@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid">
    <div class="row" style="height: 100vh;">
        <div class="col-2 col-sm-3 col-xl-2  d-md-block bg-dark sidebar p-0 m-0" >
            <div class="sticky-top ">
                <nav class=" navbar border-bottom border-white mb-3">

                            <a class="navbar-brand text-white active" href="{{ route('dashboard') }}">
                                <a href="{{ route('dashboard') }}" class="ms-2"><img class="img-fluid " style=" width:50%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"></a>

                            </a>

                </nav>
                <nav class="nav flex-column " style="height: 100%;">
                    <ul class="nav  flex-column">

                        <li class="nav-item   mb-2">
                            <a class="nav-link text-white active" href="">
                                <i class="bi bi-house"></i><span class="d-none d-sm-inline ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item  mb-2">
                            <a class="nav-link text-white" href="#">
                                <i class="bi bi-plus-circle"></i> <span class="d-none d-sm-inline ms-2">Add House</span>
                            </a>
                        </li>
                        <li class="nav-item  mb-2">
                            <a class="nav-link text-white" href="#">
                                <i class="bi bi-list"></i> <span class="d-none d-sm-inline ms-2">My Houses</span>
                            </a>
                        </li>
                        <li class="nav-item  mb-2">
                            <a class="nav-link text-white" href="#">
                                <i class="bi bi-person"></i> <span class="d-none d-sm-inline ms-2">Profile</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <div class="col-10 col-sm-9 ms-sm-auto col-xl-10 px-md-4 ">
            <nav class="navbar navbar-expand-lg bg-body-tertiary ">
                <div class="container-fluid ">
                    <h5>Hello {{session('landlord_name')}}</h5>
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <h5><i class="bi bi-person-circle"></i> {{ session('landlord_name') ?? 'Landlord' }}</h5>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="navbar-brand" href="#"><i class="bi bi-arrow-bar-right me-2">Logout</i>
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <!-- stats cards -->
    <div class="row mb-4">
        <div class=" col-4 col-md-4 col-lg-4">
            <div class="card text-black bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-house-door fs-1 me-3"></i>
                        <div>
                            <p class="card-title mb-0">My Houses</p>
                            <h2 class="card-text">{{ $housesCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-4 col-md-4 col-lg-4">
            <div class="card text-black bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-question-circle fs-1 me-3"></i>
                        <div>
                            <p class="card-title mb-0">Enquiries</p>
                            <h2 class="card-text">{{$enquiriesCount }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more cards for other stats if needed -->
    </div>
    <!-- house upload form -->
<form method="POST" action="{{ route('house.upload') }}" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">House Type</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate</label>
                        <input type="number" name="rate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">House Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success">Upload House</button>
</form>
                <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>John</td>
                <td>Doe</td>
                <td>@social</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
