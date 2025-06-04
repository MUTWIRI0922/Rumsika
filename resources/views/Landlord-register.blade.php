@extends('layouts.app')
@section('title', 'Landlord Register')
@section('content')
<style>
    html, body, .container {
           margin-top:2vw ;
           
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
           width: 30vw; /* Adjust the size of the image */
         
           height: 30vw;
          
           /* background: url('{{ asset('images/leftbottom.png') }}') no-repeat center center ; */
           background-size: cover;
           opacity: 0.9; /* Adjust transparency (0 = fully transparent, 1 = fully opaque) */
           pointer-events: none; /* Prevent the image from interfering with clicks */
              z-index: 0; /* Ensure the image is behind other content */   
         }
         input:focus {
              border-color: gold !important;
              box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25); /* optional glow */
          }
          @media (max-width: 768px) {
              .card {
                  max-width: 80vw;
                  max-height: auto;
                  margin-left: auto;
                  margin-right: auto;
              }
          }
</style>


  <div class=" justify-content-center  " >
    <div class="container">
      <div class="row  align-items-center">
        <div class="col text-center ">
          
          <img class="img-fluid" style=" width:50%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"> 
          <p class="fs-2"style="color: hsl(0, 0.00%, 100.00%)">
            Hello, our platform connects you to your potential clients.
            Create an account, post your facility details and engage.
            Let's Partner with you..
           
          </p>
        </div>

        <div class="col-xl-5 col-md-8 col-sm-10 col-12 mx-auto ">
            @if(session('success'))
                <div class="alert alert-success  fade show" id="alert">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger  fade show" id="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <!-- registration form -->
          <div class="card" id="register" style="border-radius: 1rem; border-color:gold; border-width:3px;">
            <div class="card-body  " style="background-color: green; border-radius: 1rem;">
              <form method="POST" action="{{ route('landlord.register') }}">
                @csrf
                <h2 class="fw-bold mb-4 mt-2 text-center text-uppercase" style="color: white;"> landlord Register</h2>
                <hr style="border: 3px solid gold; width: 100%; margin-bottom: 20px;">
                <!-- name input -->
                <div class="mb-4">
                    <label for="Username" class="fs-4 text-white">Name</label>
                    <input type="text" name="name" id="Username" class="form-control form-control-lg" placeholder="Enter Name" />
                <!-- Email input -->
                <div class="mb-4">
                    <label for="Username" class="fs-4 text-white">Email</label>
                  <input type="text" name="email" id="Email" class="form-control form-control-lg" placeholder="Enter Email" />
                </div>
                <!-- phone number input -->
                <div class="mb-4">
                    <label for="Username" class="fs-4 text-white">Phone number</label>
                    <input type="text" name="phone" id="PhoneNumber" class="form-control form-control-lg" placeholder="Enter Phone Number" />
                </div>
                <!-- Password input -->
                <div  class="form-outline mb-4 position-relative">
                  <label for="Password" class="fs-4 text-white">Password</label>
                  <input type="password" name="password" id="passwordInput" class="form-control form-control-lg" placeholder="Password" />
                  <span class="position-absolute top-50 end-0 translate-middle-y mt-3 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                      <i class="bi bi-eye fs-3" id="togglePasswordIcon"></i>
                  </span>
                </div>
                <!-- password confirmation -->
                <div  class="form-outline mb-4 position-relative">
                  <label for="Password" class="fs-4 text-white">Re-enter password</label>
                  <input type="password" name="password_confirmation" id="passwordrepeat" class="form-control form-control-lg" placeholder="Password" />
                  <span class="position-absolute top-50 end-0 translate-middle-y mt-3 me-3" style="cursor:pointer; height: 100%; display: flex; align-items: center;" onclick="togglePassword()">
                      <i class="bi bi-eye fs-3" id="togglePasswordIconrepeat"></i>
                  </span>
                </div>
                
                <!-- login button -->
                <div class="pt-1 mb-4 d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg btn-warning w-100 px-5">Register</button>
                </div>
                <p class="mb-5 pb-lg-2 justify-content-center" style="color:rgb(255, 255, 255);">Already have an account? <a href="{{ url('Landlord-login') }}"
                      style="color:rgb(255, 255, 255);" >Login here</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
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
        const input2 = document.getElementById('passwordrepeat');
        const icon2 = document.getElementById('togglePasswordIconrepeat');
        if (input2.type === "password") {
            input2.type = "text";
            icon2.classList.remove('bi-eye');
            icon2.classList.add('bi-eye-slash');
        } else {
            input2.type = "password";
            icon2.classList.remove('bi-eye-slash');
            icon2.classList.add('bi-eye');
        }
    }
    
        setTimeout(function() {
            var alert = document.getElementById('alert');
            if(alert){
                alert.classList.remove('show');
               
            }
        }, 4000); // 4000ms = 4 seconds

  </script>

@endsection