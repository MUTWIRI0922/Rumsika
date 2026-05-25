@extends('layouts.app')
@section('title', 'Lister Profile - Rumsika')
@section('content')
@include('mainnav')

<div class="container mt-5">
    <!-- Profile Section -->
    <div class="mb-5">

            <div class="row">
                <!-- Profile Picture -->
                <div class="col-12 col-md-4 text-center">
                    @if($lister->profile_picture)
                        <img src="{{ asset('storage/' . $lister->profile_picture) }}" 
                             alt="{{ $lister->name }}" 
                             class="img-fluid shadow-sm profile-picture">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 250px; height: 250px; margin: 0 auto;">
                            <span class="text-secondary">No Picture</span>
                        </div>
                    @endif
                </div>

                <!-- Profile Details -->
                <div class="col-8 col-md-8">
                    <p class="text-dark ">{{ $lister->name }}</p>
                    <div class="mt-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <i class="bi bi-envelope-fill text-primary"></i>
                            <span class="text-dark">{{ $lister->email }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-telephone-fill text-success"></i>
                            <span class="text-dark">{{ $lister->phone }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="badge bg-primary">Active lister</span>
                    </div><br>
                    <p>Rating: {{ $lister->reviews_count }} reviews</p>
                    <div class="text-warning">
                        @php $avg = round($lister->reviews_avg_rating ?? 0); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $avg)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Write Review Section -->

        <h5 class="text-dark mx-4 mb-4">Write a Review</h5>

        <div class="mx-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="lister_id" value="{{ $lister->id }}">
                <!-- name -->
                <label for="reviewer" class="form-label fw-semibold text-dark">Your Review  <span class="text-danger">*</span></label>
                 <input type="text" name="reviewer" id="reviewer" placeholder="Enter your name here" required>
                 
                <!-- Star Rating -->
                <div class="mb-4">
                    <br>
                    <label class="form-label fw-semibold text-dark">Rating <span class="text-danger">*</span></label><br>
                    <div class="d-flex gap-2 rating-stars">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="d-none" required />
                            <label for="star{{ $i }}" class="fs-4 text-secondary cursor-pointer rating-star">
                                ★
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- Review Text -->
                <div class="mb-4">
                    <label for="review" class="form-label fw-semibold text-dark">Your Review  <span class="text-danger">*</span></label>
                    <textarea id="review" name="review" rows="5" 
                              class="form-control" 
                              placeholder="Share your experience with this lister...">
                    </textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary fw-bold">
                    Submit Review
                </button>
            </form>
        </div>
        <br>

    <!-- Reviews Section -->
    <div class="mx-5">
        <h5 class="text-dark mb-4">Reviews</h5>

        @forelse($lister->reviews as $review)
        <div class="mb-4">

                <div class=" justify-content-between  mb-3">
                    <div>
                        <h5 class=" text-dark">{{$review->reviewer}}</h5>
                        <small class="text-secondary">{{$review->created_at->diffForHumans()}}</small>
                    </div>
                    <div class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p class="text-dark">{{$review->review}}</p>

        </div>
        @empty
            <p>No revies yet. Be the first to review the Lister.</p>
        @endforelse
    </div>
</div>

<style>
    .rating-star:hover {
        color: #ffc107 !important;
    }
    
    .rating-star {
        transition: color 0.2s ease;
    }

    .profile-picture {
        width: 100%;
        max-width: 220px;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto;
    }
    
    /* Styles for the rating stars so selecting a star highlights it and all preceding ones */
    .rating-stars{
        display: flex;  
        flex-direction: row-reverse;
        justify-content: flex-end;
        align-items: center;
    }

    .rating-stars input[type="radio"]{
        display: none;
    }

    /* When a radio is checked, color every label that comes after it (which represents the lower-valued stars) */
    .rating-stars input[type="radio"]:checked ~ label{
        color: #ffc107 !important;
    }

    /* Hovering a star highlights it and all lower stars */
    .rating-stars label:hover,
    .rating-stars label:hover ~ label{
        color: #ffc107 !important;
    }
</style>

@endsection