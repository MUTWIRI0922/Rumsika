@extends('layouts.admin')
@section('content')
<div class="container py-5">
    <h4><strong>Edit Listing: {{ Str::title($user->name)   }} listing {{ $listing->id }}</strong></h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.user.listing.update', [$user->id, $listing->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


                    <div class="mb-3">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <input type="text" name="Type" class="form-control" value="{{ $listing->Type }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location <span class="text-danger">*</span></label>
                        <input type="text" name="Location" class="form-control" value="{{ $listing->Location }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="Description" class="form-control" rows="5" required>{{ $listing->Description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rate <span class="text-danger">*</span></label>
                        <input type="number" name="Rate" class="form-control" value="{{ $listing->Rate }}" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Number of available units <span class="text-danger">*</span></label>
                        <input type="number" name="available_units" class="form-control" value="{{ $listing->available_units }}" required>
                    </div> -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label">Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <p class="form-text">Upload a image (max 2MB)</p>
                        @if($listing->image)
                            <img src="{{ asset('storage/' . $listing->image) }}" alt="listing Image" width="60" class="mt-2">
                        @endif
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Image(inside)</label>
                            <input type="file" name="image_inside" class="form-control" accept="image/*">
                            <p class="form-text">Upload a image (max 2MB)</p>
                            @if($listing->image_inside)
                                <img src="{{ asset('storage/' . $listing->image_inside) }}" alt="Inside" width="60" class="mt-2">
                            @endif
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Image(Outside)</label>
                            <input type="file" name="Image_outside" class="form-control" accept="image/*">
                            <p class="form-text">Upload a image (max 2MB)</p>
                             @if($listing->Image_outside)
                                <img src="{{ asset('storage/' . $listing->Image_outside) }}" alt="Outside" width="60" class="mt-2">
                            @endif
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Image(amenities)</label>
                            <input type="file" name="Amenities" class="form-control" accept="image/*">
                            <p class="form-text">Upload a image (max 2MB)</p>
                             @if($listing->Amenities)
                                <img src="{{ asset('storage/' . $listing->Amenities) }}" alt="Amenities" width="60" class="mt-2">
                            @endif
                        </div>


                    </div>

                    <button type="submit" class="btn btn-success">Save Changes</button>


        </form>
</div>
@endsection