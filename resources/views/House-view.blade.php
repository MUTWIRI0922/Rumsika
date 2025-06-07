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
        width: 100%;
        height: auto;
        border-radius: 4px;
        margin-right: 0%;
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
    .card-img-top {
    width: 100%;
    height: 200px;         /* Adjust height as needed */
    object-fit: cover;     /* Ensures image covers area, cropping if needed */
    border-radius: 4px;
    }
</style>
 <div class="row row-1 ms-3">
     @if(isset($select_house))
    <div class="col-md-5 d-flex justify-content-center ">
        <img src="{{ asset('storage/' . $select_house->image)}}" alt=" house image" srcset="" style="width: 100%; height: 400px;">
    </div>
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-4" role="alert" style="z-index: 9999; min-width: 250px;">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Showing details of the selected house -->

            <div class="col-md-5  ">
            <h1>{{ $select_house->Type ?? 'House Name' }}</h1>
            <div class="row">
                <div class="col"><p><b>Posted by: {{ $select_house->landlord->name ?? 'Unknown' }}</b></p></div>
                <div class="col"><p><b>Tel: {{ $select_house->landlord->phone ?? 'N/A' }}</b></p></div>
            </div>
            <p>Description:{{ $select_house->Description ?? 'House Description' }}</p>
            <p>Rate: <b>{{ $select_house->Rate ?? 'N/A' }}</b>/Month</p>
            <p>Location: <b>{{ $select_house->Location ?? 'N/A' }}</b></p></p>
            <p>Type: <b>{{ $select_house->Type ?? 'N/A' }}</b></p>

            <form id="enquiryForm" method="POST"  action="{{ route('enquiries.store') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="house_id" value="{{ $select_house->id }}">
                <button type="submit" class="btn btn-warning" id="contactSellerBtn">
                    Contact Seller
                </button>
            </form>
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
    @endif

 </div>
 <br><br>
 <h3 style="margin-left: 5%; margin-bottom:0;"><i class="bi bi-filter-right"></i> Other Available spaces</h3>
<!-- Show available houses in a grid format -->
 <div class="row row-2">
         @forelse($houses as $house)
            <div class="col-6 col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="card flex-fill">
                                    <img src="{{ asset('storage/' . $house->image)}}" class="card-img-top" style="max-width:px;" alt="House Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $house->Type ?? 'N/A' }}</h5>
                                        <p class="card-text align-text-center">
                                            in <b>{{ $house->Location ?? 'N/A' }}</b>
                                            For <b>{{ $house->Rate ?? 'N/A' }}</b>/Month
                                        </p>
                                        <a href="{{url('/House-view/' .$house->id )}}" class="btn btn-warning">Details</a>
                                    </div>
                </div>
            </div>

          @empty
            <p>No houses found.</p>
        @endforelse

</div>

<br><br>
@include('mainfooter')
    <script>
document.getElementById('enquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);

    // Open a blank tab immediately


    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    then(data => {
        if(data.whatsapp_url){
            window.open(data.whatsapp_url, '_blank');
        } else {
            alert('Could not generate WhatsApp link.');
        }
    })
    .catch(() => {
        alert('An error occurred. Please try again.');
    });
});
</script>
@endsection
