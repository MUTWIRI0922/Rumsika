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
    <button onclick="topFunction()" id="backToTopBtn" title="Go to top" style="display:none;position:fixed;bottom:20px;right:0px;z-index:9999;" class="btn btn-success w-10 h-10 rounded-circle shadow">
    <i class="bi bi-arrow-up"></i>
</button>

    <script>
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