<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <!-- Add this in your layouts/app.blade.php head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
     <style>
        body {
            font-family: 'Roboto', sans-serif;
            
        }
        
     </style>
</head>
<body>
    <div id="app">
        @yield('content')

    </div>
    <!-- Loader Overlay -->
    <div id="loader-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:2000;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;">
        <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <button onclick="topFunction()" id="backToTopBtn" title="Go to top" style="display:none;position:fixed;bottom:20px;right:0px;z-index:9999;" class="btn btn-success w-10 h-10 rounded-circle shadow">
    <i class="bi bi-arrow-up"></i>
</button>

    <script>
        // Hide the loader overlay when the page is fully loaded
        window.addEventListener('load', function() {
        document.getElementById('loader-overlay').style.display = 'none';
    });
        // Back to top button functionality
        window.onscroll = function() {
            const backToTopBtn = document.getElementById("backToTopBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
</body>
</html>