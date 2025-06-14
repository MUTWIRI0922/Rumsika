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
    }
</style>
<div class="container-fluid">
    <div class="row" style="height: 100vh;">
        <div class="col-1 col-sm-3 col-xl-2  d-md-block bg-success sidebar p-0 m-0" >
            <div class="sticky-top ">
                <nav class=" navbar border-bottom border-white mb-3 w-100">

                            <a class="navbar-brand text-white active" href="{{ route('dashboard') }}">
                                <a href="{{ route('dashboard') }}" class="ms-2"><img class="img-fluid " style=" width:50%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"></a>

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
        <div class="col-10 col-sm-9 ms-sm-auto col-xl-10 px-md-0 ">
            <nav class="navbar navbar-expand-lg  bg-body-tertiary  ">
                <div class="container-fluid ">
                    <h5>Hello {{session('landlord_name')}}</h5>
                    <ul class="navbar-nav ms-auto flex-row align-items-center">
                        <li class="nav-item me-3">
                            <h5><i class="bi bi-person-circle"></i> {{ session('landlord_name') ?? 'Landlord' }}</h5>
                        </li>
                        <li class="nav-item ms-3">
                            <a class="navbar-brand" href="#"><i class="bi bi-arrow-bar-right me-2">Logout</i>
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
            <br>
            <div class="px-md-4">
                <!-- stats cards -->
                @if(request('section', 'dashboard')== 'dashboard')
                    <div class="row mb-4">
                        <div class=" col-4 col-md-4 col-lg-3">
                            <div class="card text-black bg-warning mb-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-house-door fs-1 me-2"></i>
                                        <div>
                                            <p class="card-title mb-0">My Houses</p>
                                            <h2 class="card-text">{{ $housesCount }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" col-4 col-md-4 col-lg-3 ">
                            <div class="card text-black bg-warning mb-3 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-question-circle fs-1 me-2"></i>
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
                    <div class="card mb-4 col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Enquiries This Year</h5>
                            <canvas id="enquiriesChart" height="100" ></canvas>
                        </div>
                    </div>
                    <div class=" mb-4 col-md-6">
                        <a href="{{ route('dashboard', ['section' => 'my-houses']) }}" class="btn btn-success me-3">View my Houses</a>
                        <a href="{{ route('dashboard', ['section' => 'add-house']) }}" class="btn btn-success me-3">Post a House</a>
                        <a href="{{ route('dashboard', ['section' => 'profile']) }}" class="btn btn-success me-3">View profile</a>
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
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>Rate</th>
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
                                    <td>{{ $house->Rate }}</td>
                                    <td>
                                        @if($house->image)
                                            <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" width="60">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                </li>

                                                <li>
                                                    <!-- Edit triggers the modal for this house -->
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editHouseModal{{ $house->id }}">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form method="POST" action="" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this house?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Edit House Modal -->
                                         <div class="modal fade" id="editHouseModal{{ $house->id }}" tabindex="-1" aria-labelledby="editHouseModalLabel{{ $house->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-top modal-lg modal-sm-mobile">
                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
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

                    <form class="mb-4 col-10" id="profileForm" method="POST" action="">
                      @csrf
                      <div class="row">
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

                        <button type="button" class="btn btn-primary" id="editBtn">Edit</button>
                        <button type="submit" class="btn btn-success d-none" id="saveBtn">Save</button>
                    </form>
                @endif
                <!-- Edit Profile Modal -->
                <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                    <form method="POST" action="" class="mb-4 col-8 col-10">
                        @csrf
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
                            <input type="password" name="confirmnew" class="form-control" id="confirmpwd" placeholder="Confirm new password">
                            <span class="position-absolute top-50 end-0 translate-middle-y mt-2 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                                <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                        <a href="" class="btn btn-success">Change Password</a>
                    </form>
                @endif
            </div>



        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('enquiriesChart').getContext('2d');
            var enquiriesData = @json($enquiriesData);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Enquiries',
                        data: enquiriesData,
                        borderColor: 'rgb(173, 131, 6)',
                        backgroundColor: 'rgba(169, 129, 10, 0.2)',
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
