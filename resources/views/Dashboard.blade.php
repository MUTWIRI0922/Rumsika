@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<style>
    @media (max-width: 576px) {
        .modal-sm-mobile {
            max-width: 80vw !important;
            max-height: 80vh !important;
            overflow-y: auto;
            margin: 1.75rem auto;
        }
        .modal-dialog{
            max-width: 80vw !important;
            max-height: 80vh !important;
            overflow-y: auto;
            margin: 1.75rem auto;
            padding: 2rem;
        }
        .l_name{
            font-size: 0.8rem;
        }
        .top-nav,
        .top-nav .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
           
        }
        
    }
    .top-nav{
        position: sticky;
        width: 100%;
        background-color: white;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        top: 0;
        z-index: 1001;
       
    }
    .landlord-navbar-btn {
    text-decoration: none !important;
    color: #198754 !important; /* Bootstrap green */
    border: none !important;
    background: none !important;
    box-shadow: none !important;
    }
    
    /* .row, .container-fluid, .col-9, .col-sm-9, .col-xl-10 {
        overflow: visible !important;
        }
        .dropdown-menu {
        z-index: 3000 !important;
    } */ */
 
</style>
<div class="container-fluid">
    <div class="row" style="height: 100vh;">
        <div class="col-2 col-sm-3 col-xl-2  d-md-block bg-success sidebar p-0 m-0" >
            <div class="sticky-top ">
                <nav class=" navbar border-bottom border-white mb-3 w-100">

                            <a class="navbar-brand text-white active" href="{{ route('dashboard') }}">
                                <a href="{{ route('dashboard') }}" class="ms-2"><img class="img-fluid " style=" width:70%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"></a>

                            </a>

                </nav>
                <nav class="nav flex-column w-100" style="height: 100%;">
                    <ul class="nav  flex-column w-100">

                        <li class="nav-item w-100  mb-2">
                            <a class="nav-link text-white {{ request('section', 'dashboard') == 'dashboard' ? 'bg-warning' : '' }}" href="{{ route('dashboard', ['section' => 'dashboard']) }}">
                                <i class="bi bi-house"></i><span class="d-none d-sm-inline ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item w-100 mb-2">
                            <a class="nav-link text-white {{ request('section') == 'add-house' ? 'bg-warning' : '' }}" href="{{ route('dashboard', ['section' => 'add-house']) }}">
                                <i class="bi bi-plus-circle"></i> <span class="d-none d-sm-inline ms-2">Add House</span>
                            </a>
                        </li>
                        <li class="nav-item w-100 mb-2">
                            <a class="nav-link text-white {{ request('section') == 'my-houses' ? 'bg-warning' : '' }}" href="{{ route('dashboard', ['section' => 'my-houses']) }}">
                                <i class="bi bi-list"></i> <span class="d-none d-sm-inline ms-2">My Houses</span>
                            </a>
                        </li>
                        <li class="nav-item w-100 mb-2">
                            <a class="nav-link text-white {{ request('section') == 'profile' ? 'bg-warning' : '' }}" href="{{ route('dashboard', ['section' => 'profile']) }}">
                                <i class="bi bi-person"></i> <span class="d-none d-sm-inline ms-2">Profile</span>
                            </a>
                        </li>
                         <li class="nav-item w-100 mb-2">
                            <a class="nav-link text-white {{ request('section') == 'password' ? 'bg-warning' : '' }}" href="{{ route('dashboard', ['section' => 'password']) }}">
                                <i class="bi bi-key-fill"></i> <span class="d-none d-sm-inline ms-2">Change password</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <div class="col-10 col-sm-9  col-xl-10 px-md-0 ">
            <nav class="navbar top-nav navbar-expand-lg  bg-body-tertiary  ">
                <div class="container-fluid d-flex align-items-center text-success ">
                    <h5 class="l_name mb-0"><i>Welcome back,</i></h5>

                    <div class="dropdown  " style="margin-right: 2rem !important;">
                       <button class="dropdown-toggle d-flex align-items-center btn btn-link landlord-navbar-btn" id="landlordDropdown"  data-bs-toggle="dropdown" aria-expanded="false">
                            @if(!empty($landlord->profile_picture))
                                <img src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle me-2" width="32" height="32" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle me-2" width="32" height="32" style="object-fit:cover;">
                            @endif
                            {{ session('landlord_name') }}
                        </button>
                            <ul class="dropdown-menu " aria-labelledby="landlordDropdown">
                                <li class="dropdown-item ">
                                    <a class="bi bi-person-circle nav-link" href="{{ route('dashboard', ['section' => 'profile']) }}"> My Profile</a>
                                </li>
                                <li class="dropdown-item">
                                        <a  href="{{ route('landlord.logout') }}" class="bi bi-arrow-bar-right nav-link"> Logout</a>
                                </li>
                            </ul>
                    </div>
                </div>
            </nav>
   
            <br>
            <div class="px-md-4 px-lg-5 py-3 main-content">
                <!-- stats cards -->
                @if(request('section', 'dashboard')== 'dashboard')
                <br><br>
                    <div class="row mb-4">
                        <div class=" col-6 col-md-4 col-lg-3">
                            <div class="card text-black bg-warning mb-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-house-door fs-1 me-1"></i>
                                        <div>
                                            <p class="card-title mb-0">My Houses</p>
                                            <h2 class="card-text">{{ $housesCount }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-6 col-md-4 col-lg-3 ">
                            <div class="card text-black bg-warning mb-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-question-circle fs-1 me-1"></i>
                                        <div>
                                            <p class="card-title mb-0">Enquiries</p>
                                            <h2 class="card-text">{{$enquiriesCount }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class=" col-6 col-md-4 col-lg-3 ">
                            <div class="card text-black bg-warning mb-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-eye fs-1 me-1"></i>
                                        <div>
                                            <p class="card-title mb-0">Views</p>
                                            <h2 class="card-text">{{$viewsCount }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more cards for other stats if needed -->
                    </div>
                    <div class="row">
                        <div class="card mb-4 col-md-5 ms-2">
                            <div class="card-body">
                                <h5 class="card-title">Enquiries This Year</h5>
                                <canvas id="enquiriesChart" height="200" ></canvas>
                            </div>
                        </div>
                        <div class="card mb-4 col-md-5 ms-2">
                            <div class="card-body">
                                <h5 class="card-title">Total Views This Year</h5>
                                <canvas id="viewsChart" height="200" ></canvas>
                            </div>
                        </div>
                    </div>

                    <div class=" mb-4 row">
                        <a href="{{ route('dashboard', ['section' => 'my-houses']) }}" class="btn btn-success col-3 col-lg-2 ms-3">View my Houses</a>
                        <a href="{{ route('dashboard', ['section' => 'add-house']) }}" class="btn btn-success col-3 col-lg-2 ms-3">Post a House</a>
                        <a href="{{ route('dashboard', ['section' => 'profile']) }}" class="btn btn-success col-3 col-lg-2 ms-3">View profile</a>
                    </div>
                @endif

                    <!-- house upload form -->
                @if(request('section')== 'add-house')
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    @if($errors->any())
                                        <div class="alert alert-danger col-12">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                    <br><h3>Add House</h3><br>
                    <form method="POST" action="{{ route('house.upload') }}" enctype="multipart/form-data" class="col-12 col-lg-8 mb-4">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">House Type<span class="text-danger">*</span></label>
                                            <input type="text" name="type" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Location<span class="text-danger">*</span></label>
                                            <input type="text" name="location" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description<span class="text-danger">*</span> </label>
                                            <textarea name="description" class="form-control" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Rate<span class="text-danger">*</span></label>
                                            <input type="number" name="rate" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">House Image<span class="text-danger">*</span></label>
                                            <input type="file" name="image" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">House Image (Inside)</label>
                                            <input type="file" name="image_inside" class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">House Image (Outside)</label>
                                            <input type="file" name="Image_outside" class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image (Amenities)</label>
                                            <input type="file" name="Amenities" class="form-control" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-success">Upload House</button>
                    </form>
                @endif
                <!-- list of houses -->
                @if(request('section')== 'my-houses')
                    <br><h3>Your Houses</h3><br><br>

                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if(session('success'))
                                                    <div class="alert alert-success">{{ session('success') }}</div>
                                                @endif
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Time</th>
                                <th>Rate</th>
                                <th>Views</th>
                                <th>Image</th>
                                <th>Actions</th> {{-- New column for buttons --}}
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse($houses as $index => $house)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $house->Type }}</td>
                                    <td>{{ $house->Location }}</td>
                                    <td>
                                        @php
                                            $points = preg_split('/\r\n|\r|\n/', $house->Description ?? '');
                                        @endphp

                                        <ul>
                                            @foreach($points as $point)
                                                @if(trim($point) !== '')
                                                    <li>{{ $point }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <p>{{ $house->created_at->diffForHumans(null, null, true) ?? 'N/A' }}</p>
                                    </td>
                                    <td>{{ $house->Rate }}</td>
                                    <td>{{$HviewsCount[$house->id] ?? 0}}</td>
                                    <td>
                                        @if($house->image)
                                            <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="60">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <!-- actions button -->
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewHouseModal{{ $house->id }}">
                                                        <i class="bi bi-eye"></i> View
                                                    </button>
                                                </li>

                                                <li>
                                                  
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editHouseModal{{ $house->id }}">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form method="POST" action="" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteHouseModal{{ $house->id }}">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- view house modal -->
                                        <div class="modal fade" id="viewHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="viewHouseModalLabel{{ $house->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg modal-sm-mobile">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewHouseModalLabel{{ $house->id }}">House Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Type:</strong> {{ $house->Type }}</p>
                                                        <p><strong>Location:</strong> {{ $house->Location }}</p>
                                                        <p><strong>Description:</strong><br>
                                                            @php
                                                                $points = preg_split('/\r\n|\r|\n/', $house->Description ?? '');
                                                            @endphp
                                                            <ul>
                                                                @foreach($points as $point)
                                                                    @if(trim($point) !== '')
                                                                        <li>{{ $point }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </p>
                                                        <p><strong>Rate:</strong> {{ $house->Rate }}</p>
                                                        <p><strong>Views:</strong> {{ $HviewsCount[$house->id] ?? 0 }}</p>
                                                        <div>
                                                            @if($house->image)
                                                                <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="120" class="me-2 mb-2">
                                                            @endif
                                                            @if($house->image_inside)
                                                                <img src="{{ asset('storage/' . $house->image_inside) }}" alt="Inside" width="120" class="me-2 mb-2">
                                                            @endif
                                                            @if($house->Image_outside)
                                                                <img src="{{ asset('storage/' . $house->Image_outside) }}" alt="Outside" width="120" class="me-2 mb-2">
                                                            @endif
                                                            @if($house->Amenities)
                                                                <img src="{{ asset('storage/' . $house->Amenities) }}" alt="Amenities" width="120" class="me-2 mb-2">
                                                            @endif
                                                        </div>
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editHouseModal{{ $house->id }}">
                                                             <i class="bi bi-pencil"></i> Edit
                                                        </button>
                                                        <form method="POST" action="" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteHouseModal{{ $house->id }}">
                                                                <i class="bi bi-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Edit House Modal -->
                                         <div class="modal fade" id="editHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="editHouseModalLabel{{ $house->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-top modal-lg modal-sm-mobile">

                                                <form method="POST" action="{{ route('house.update', $house->id) }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editHouseModalLabel{{ $house->id }}">Edit House</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                                                <input type="text" name="type" class="form-control" value="{{ $house->Type }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                                                <input type="text" name="location" class="form-control" value="{{ $house->Location }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                <textarea name="description" class="form-control" required>{{ $house->Description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Rate <span class="text-danger">*</span></label>
                                                                <input type="number" name="rate" class="form-control" value="{{ $house->Rate }}" required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                                                <input type="file" name="image" class="form-control" accept="image/*">
                                                                @if($house->image)
                                                                    <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="60" class="mt-2">
                                                                @endif
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Image(inside)</label>
                                                                    <input type="file" name="image_inside" class="form-control" accept="image/*">
                                                                    @if($house->image_inside)
                                                                        <img src="{{ asset('storage/' . $house->image_inside) }}" alt="Inside" width="60" class="mt-2">
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Image(Outside)</label>
                                                                    <input type="file" name="Image_outside" class="form-control" accept="image/*">
                                                                    @if($house->Image_outside)
                                                                        <img src="{{ asset('storage/' . $house->Image_outside) }}" alt="Outside" width="60" class="mt-2">
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Image(amenities)</label>
                                                                    <input type="file" name="Amenities" class="form-control" accept="image/*">
                                                                    @if($house->Amenities)
                                                                        <img src="{{ asset('storage/' . $house->Amenities) }}" alt="Amenities" width="60" class="mt-2">
                                                                    @endif
                                                                </div>


                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- delete house modal -->
                                        <div class="modal fade" id="deleteHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="deleteHouseModalLabel{{ $house->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteHouseModalLabel{{ $house->id }}">Delete House</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this house?
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('house.delete', $house->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No houses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>

                @endif
                <!-- Profile section -->
                @if(request('section')== 'profile')
                    <br><h3>Your Profile</h3><br><br>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                    <form class="mb-4 col-10" id="profileForm" method="POST" action="">
                      @csrf
                      
                      <div class="row">
                        <div class="col-6 mb-4 text-center">
                            @if(!empty($landlord->profile_picture))
                                <img src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
                            @else
                                <img src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
                            @endif
                        </div>
                                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $landlord->name ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $landlord->email ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="{{ $landlord->phone ?? '' }}" readonly>
                        </div>
                      </div>

                        <button type="button" class="btn btn-primary" id="editBtn" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                        <button type="button" class="btn btn-primary" id="kycVerifyBtn" data-bs-toggle="modal" data-bs-target="#kycVerifyModal">KYC Verify</button>
                        <button type="submit" class="btn btn-success d-none" id="saveBtn">Save</button>
                    </form>
                @endif
                <!-- KYC Verification Modal -->
                <div class="modal fade" id="kycVerifyModal" tabindex="-1" aria-labelledby="kycVerifyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="" id="kycVerifyForm">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="kycVerifyModalLabel">KYC Verification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <label for="id_photo">Upload ID Document:</label>
                                        <input type="file" name="id_photo" required><br><br>
                                        <label>Capture Selfie:</label><br>
                                        <video id="video" width="300" autoplay></video><br>
                                        <button type="button" onclick="takeSnapshot()">Capture Selfie</button><br>
                                        <!-- <canvas id="canvas" width="300" height="200" style="display:none;"></canvas> -->
                                        <input type="hidden" name="selfie_data" id="selfie_data">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Profile Modal -->
                <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{route('landlord.updateProfile', $landlord->id)}}" id="editProfileForm" enctype="multipart/form-data">
                    @csrf
                                    
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-4 text-center position-relative" style="width: 130px; margin: 0 auto;">
                            @if(!empty($landlord->profile_picture))
                                <img id="profilePicPreview" src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
                            @else
                                <img id="profilePicPreview" src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle" width="120" height="120" style="object-fit:cover;">
                            @endif
                            <label for="profilePicInput" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1 shadow" style="cursor:pointer;">
                                <i class="bi bi-pencil text-primary"></i>
                                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*" class="d-none">
                            </label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $landlord->name ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $landlord->email ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $landlord->phone ?? '' }}">
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
                <!-- password change -->
                @if(request('section')== 'password')
                    <br><h3>Change Password</h3><br><br>
                    <form method="POST" action="{{ route('landlord.changePassword') }}" class="mb-4 col-8 col-10">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-outline col-md-6 mb-4 position-relative">
                            <label for="currentpwd">Current Password</label>
                            <input type="password" name="current" class="form-control" id="currentpwd" placeholder="Enter Current Password"><br>
                            <span class="position-absolute top-50 end-0 translate-middle-y mt-0 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                                <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
                            </span>
                        </div>

                        <div class="form-outline col-md-6 mb-4 position-relative">
                            <label for="newpwd">New Password</label>
                            <input type="password" name="new" class="form-control" id="newpwd" placeholder="Enter New Password"><br>
                            <span class="position-absolute top-50 end-0 translate-middle-y mt-0 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                                <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
                            </span>
                        </div>


                        <div class="form-outline col-md-6 mb-4 position-relative">
                            <label for="confirmnew">Confirm password</label>
                            <input type="password" name="new_confirmation" class="form-control" id="confirmpwd" placeholder="Confirm new password">
                            <span class="position-absolute top-50 end-0 translate-middle-y mt-2 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                                <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </form>
                @endif
            </div>



        </div>
    </div>
</div>
    @vite('resources/js/selfie.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
     
        document.addEventListener('DOMContentLoaded', function () {
          
            // Handle profile picture preview
            document.querySelectorAll('#profilePicInput').forEach(function(input) {
                input.addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    if (file) {
                        // Find the closest preview image in the same modal/form
                        const preview = event.target.closest('div.position-relative').querySelector('#profilePicPreview');
                        if (preview) {
                            preview.src = URL.createObjectURL(file);
                        }
                    }
                });
            });
            // Fade out alerts after 3 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert-success, .alert-danger, .alert-warning').forEach(function(alert) {
                    alert.classList.add('fade');
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500); // Remove from DOM after fade
                });
            }, 3000);
            // Initialize the enquiries chart
            var ctx = document.getElementById('enquiriesChart').getContext('2d');
            var enquiriesData = @json($enquiriesData);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Enquiries',
                        data: enquiriesData,
                        borderColor: 'rgb(255, 191, 0)',
                        backgroundColor: 'rgb(255, 191,  0)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
            // Initialize the views chart
            var ctx2 = document.getElementById('viewsChart').getContext('2d');
            var viewsData = @json($viewsData);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Views',
                        data: viewsData,
                        borderColor: 'rgb(6, 131, 6)',
                        backgroundColor: 'rgba(10, 169, 10, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });


            document.getElementById('editBtn').onclick = function() {
                let form = document.getElementById('profileForm');
                form.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
                document.getElementById('saveBtn').classList.remove('d-none');
                this.classList.add('d-none');
            };

            function togglePassword() {
                const input = document.getElementById('currentpwd');
                const icon = document.getElementById('togglePasswordIcon');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = "password";
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        });

    </script>
@endsection
