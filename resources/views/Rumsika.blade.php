@extends ('layouts.app')
@section('title', 'Rumsika')
@section('content')
  <style>
       html, body, .container {
           margin: 0;
           padding: 0;
           height: 100%;
           background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), 
                       url('{{ asset('images/exterior-design-shutterstock_193966368-100x700-compressed.jpg') }}') 
                       no-repeat center center fixed;
           background-size: cover;
           background-color: black;
       }
       body::after {
           content: "";
           position: absolute;
           bottom: 0;
           right: 0;
           width: 800px; /* Adjust the size of the image */
           height: 800px;
           background: url('{{ asset('images/leftbottom.png') }}') no-repeat center center;
           background-size: contain;
           opacity: 0.9; /* Adjust transparency (0 = fully transparent, 1 = fully opaque) */
           pointer-events: none; /* Prevent the image from interfering with clicks */
       }
       #app {
           min-height: 100%;
       }
       .main {
           position: absolute;
           top: 47%;
           left: %;
           transform: translate(0, -50%);
       }
  </style>
   <div class="container  text-white ">
    <div class="main  align-middle align-items-center text-center  mt-10 ml-3">
      <div class="col-6 w-100 mt-5">
      <img class="img-fluid" style=" width:5%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"> 
      <p class="mt-0 fs-4 fw-bold">A Landlord-tenant connection Platform.</p>
      <p class="fs-5">Rumsika connects you directly to your potential Landlord or tenant, from wherever you are across the Kenyan territory.</p>
      <div class="row justify-content-center mt-">
      <div class="col-">
        <button  class="btn btn-primary">Tenant</button>
      </div>
      <div class="col-">
        <button class="btn btn-primary">Landlord</button>
      </div>
    </div>
    </div>
   
   </div>
@endsection