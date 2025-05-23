@extends ('layouts.app')
@section('title', 'Rumsika')
@section('content')
  <style>
    
       html, body, .container {
           margin: 0;
           padding: 0;
           height: 100%;
           background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), 
                       url('{{ asset('images/exterior-design-shutterstock_1932966368-1200x700-compressed.jpg') }}') 
                       no-repeat center center fixed;
           background-size: cover;
           background-color: black;
          
       }
       body::after {
           content: "";
           position: fixed;
           bottom: 0;
           right: 0;
           width: 40vw; /* Adjust the size of the image */
         
           height: 40vw;
          
           background: url('{{ asset('images/leftbottom.png') }}') no-repeat center center ;
           background-size: cover;
           opacity: 0.9; /* Adjust transparency (0 = fully transparent, 1 = fully opaque) */
           pointer-events: none; /* Prevent the image from interfering with clicks */
              z-index: 0; /* Ensure the image is behind other content */   
         }
        #app {
           min-height: 100%;
       } 
       .main {
             
            width: 100%;
            margin-left: -10vw;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
           
            padding-top: 40px;
            font-size: 1.5rem;
            
          
       }
       @media (max-width: 768px) {
           .main {
               min-height: 60vh;
               padding-top: 30px;
               margin-left: 0vw;
               font-size: 1rem;
           }
           .main img {
               width: 60vw !important;
               max-width: 200px;
           }
           .main  {
               width: 100% !important;
           }
          
           
           body::after {
               width: 80vw;
               height: 80vw;
               max-width: 250px;
               max-height: 250px;
           }
          }
       @media (max-width: 480px) {
           .main {
               min-height: 50vh;
               padding-top: 20px;
           }
           .main img {
               width: 80vw !important;
               max-width: 150px;
           }
           
           body::after {
               width: 100vw;
               height: 100vw;
               max-width: 180px;
               max-height: 180px;
           }
       }
    </style>
   <div class="container  text-white ">
    <div class="main  align-middle align-items-center text-center  mt-10 ">
      <div class=" w-100 mt-3">
        <img class="img-fluid" style=" width:25%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"> 
        <p class="mt-1  fw-bold">A Landlord-tenant connection Platform.</p>
        <p class="mt-0">Rumsika connects you directly to your potential Landlord or tenant,<br> from wherever you are across the Kenyan territory.</p>
        <div class="row justify-content-center mt-3">
          <div class="col-2  mb-2 ">
            <a class="btn btn-warning " href="{{ url('Tenant') }}">Tenant</a>
          </div>
          <div class="col-2  mb-2  ">
            <a class="btn btn-warning " href="{{ url('Landlord-login') }}">Landlord</a>
          </div>
        </div>
     </div>
    </div>
    @include('mainfooter')
@endsection