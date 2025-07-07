@extends('layouts.app')
@section('title', 'House View')
@section('content')
@include('mainnav')
<style>
    .row-1 {
        align-items: stretch; /* Make columns equal height */
        justify-content: center;
        display: flex;
    }
    .main-image-col {
        display: flex;
        align-items: stretch;
    }
    #mainhouseimage {
        width: 100%;
        max-height: 500px !important;
        max-width: 600px;
        object-fit: cover;
        border-radius: 4px;
        /* Remove inline height if present */
    }
    @media (max-width: 991.98px) { /* Bootstrap lg breakpoint */
        .row-1 {
            flex-direction: column;
        }
        .main-image-col, .details-col {
            min-height: auto !important;
        }
        #mainhouseimage {
            height: 200px;
        }
    }
    .details-col h1,
    .details-col p,
    .details-col ul,
    .details-col form {
        margin-top: 0.2rem;
        margin-bottom: 0.2rem;
    }

    .details-col ul {
        padding-left: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .details-col li {
        margin-bottom: 0.2rem;
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
    .row-3 img {
    width: 60%;
    height: 100px;      /* Set your desired height */
    object-fit: cover;  /* Ensures images are cropped to fit */
    border-radius: 4px;
    margin-bottom: 10px;
    }
        .card.house-card .btn {
    width: 100%;
    font-size: 0.8rem;
    padding: 0.3rem 0;
    }
    .row-3 {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    @media (max-width:576px){
        #mainhouseimage {
            width: 100%;
            height: 300px;
        }
        .card.house-card {
        /* min-height: 220px;
        max-height: 220px; */
        display: flex;
        flex-direction: column;
        justify-content: stretch;
        }
        .card.house-card .card-img-top {
            height: 100px;
            object-fit: cover;
        }
        .card.house-card .card-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 0.6rem;
            min-height: 80px;
        }
        .card.house-card .card-title {
            font-size: 0.7rem;
        }
        .card.house-card .card-text {
            font-size: 0.6rem;
        }
        .card.house-card .btn {
            width: 100%;
            margin-top: auto;
        }
    }
    
</style>
 <div class="row row-1 mx-1 mt-5">
    <br>
     @if(isset($select_house))
    <div class="col-md-5 main-image-col d-flex justify-content-center">
        <img id="mainhouseimage" src="{{ asset('storage/' . $select_house->image)}}" alt=" house image">
    </div>
    <div class="col-md-5 details-col d-flex flex-column justify-content-between">
        <!-- Showing details of the selected house -->

              <h1>{{ $select_house->Type ?? 'House Name' }}</h1>
              <p>Posted: <b>{{ $select_house->created_at->diffForHumans() ?? 'N/A' }}</b></p>
              @php
                    $maskedPhone = substr($select_house->landlord->phone, 0, 4) . '***' . substr($select_house->landlord->phone, -3);
              @endphp
            <div class="row">
                <div class="col"><p><b>Posted by: {{ $select_house->landlord->name ?? 'Unknown' }}</b></p></div>
                <div class="col"><p><b>Tel: {{ $maskedPhone ?? 'N/A' }}</b></p></div>
            </div>
            @php
                $points = preg_split('/\r\n|\r|\n/', $select_house->Description ?? '');
            @endphp
             <p>Description:</p>
            <ul>
                @foreach($points as $point)
                    @if(trim($point) !== '')
                        <li>{{ $point }}</li>
                    @endif
                @endforeach
            </ul>
            <p>Rate: <b>{{ $select_house->Rate ?? 'N/A' }}</b>/Month</p>
            <p>Location: <b>{{ $select_house->Location ?? 'N/A' }}</b></p></p>
            <!-- <p>Type: <b>{{ $select_house->Type ?? 'N/A' }}</b></p> -->
            <form id="enquiryForm" method="POST"  action="{{ route('enquiries.store') }}" style="display:inline;">
                @csrf
                <input type="hidden" name="house_id" value="{{ $select_house->id }}">
                <button type="submit" class="btn btn-warning" id="contactSellerBtn">
                    Contact Seller
                </button>
            </form>
            <div class="row row-3">
                @if($select_house->image_inside)
                    <div class="col"><img src="{{ asset('storage/' . $select_house->image_inside) }}" alt="Image 1"
                    onclick="setMainImage(this)">
                    </div>
                @endif
                @if($select_house->Image_outside)
                    <div class="col"><img src="{{ asset('storage/' . $select_house->Image_outside) }}" alt="Image 2"
                    onclick="setMainImage(this)">
                    </div>
                @endif
                @if($select_house->Amenities)
                    <div class="col"><img src="{{ asset('storage/' . $select_house->Amenities) }}" alt="Image 3"
                    onclick="setMainImage(this)">
                    </div>
                @endif
            </div>
    </div>
    @endif

 </div>
 <br><br>
 <h3 style="margin-left: 5%; margin-bottom:0;"><i class="bi bi-filter-right"></i> Other Available spaces</h3>
<!-- Show available houses in a grid format -->
 <div class="row row-2" id="availableSpaces">
         @forelse($houses as $house)
            <div class="col-6 col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="card house-card flex-fill">
                                    <img src="{{ asset('storage/' . $house->image)}}" class="card-img-top"  alt="House Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $house->Type ?? 'N/A' }}</h5>
                                        <p class="card-text align-text-center">
                                            in <b>{{ $house->Location ?? 'N/A' }}</b>
                                            For <b>{{ $house->Rate ?? 'N/A' }}</b>/Month
                                        </p>
                                        <div class="row">
                                            <div class="col">
                                                <p>Posted: <b>{{ $house->created_at->diffForHumans(null, null, true) ?? 'N/A' }}</b></p>
                                            </div>
                                            <div class="col">
                                                <i class="bi bi-eye">{{$viewsCount[$house->id] ?? 0}}</i>
                                            </div>
                                        </div>
                                         <form action="{{ route('house.view.record', ['id' => $house->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="house_id" value="{{ $house->id }}">
                                            <input type="hidden" name="client_ip" value="{{ request()->ip() }}">
                                            <button type="submit" class="btn btn-warning">Details</button>
                                         </form>
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
        function setMainImage(img) {
            document.getElementById('mainhouseimage').src = img.src;
        }
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
            .then(data => {
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
       
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');
        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const availableSpaces = document.getElementById('availableSpaces');
            const cards = availableSpaces.querySelectorAll('.house-card');
            let anyVisible = false;
            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                if (text.includes(query)) {
                    card.parentElement.style.display = '';
                    anyVisible = true;
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
            const noResults = document.getElementById('noResults');
            if (noResults) noResults.style.display = anyVisible ? 'none' : 'block';
        });
    });

</script>
@endsection
