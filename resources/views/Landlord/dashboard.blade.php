@extends('layouts.landlord')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid p-0">
    <div class="row g-3">

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-house-door fs-1 me-2 text-success"></i>
                            <div>
                                <p class="card-title mb-0 text-muted">My Houses</p>
                                <h2 class="card-text mb-0">{{ $housesCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-question-circle fs-1 me-2 text-success"></i>
                            <div>
                                <p class="card-title mb-0 text-muted">Enquiries</p>
                                <h2 class="card-text mb-0">{{ $enquiriesCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-eye fs-1 me-2 text-success"></i>
                            <div>
                                <p class="card-title mb-0 text-muted">Views</p>
                                <h2 class="card-text mb-0">{{ $viewsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Enquiries This Year</h5>
                        <canvas id="enquiriesChart" height="220"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Views This Year</h5>
                        <canvas id="viewsChart" height="220"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <a href="{{ route('dashboard', ['section' => 'my-houses']) }}" class="btn btn-success">View my Houses</a>
                    <a href="{{ route('dashboard', ['section' => 'add-house']) }}" class="btn btn-success">Post a House</a>
                    <a href="{{ route('dashboard', ['section' => 'profile']) }}" class="btn btn-success">View profile</a>
                </div>
            </div>

    </div>
</div>
    <script src="../js/selfie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

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


        });

    </script>
@endsection
