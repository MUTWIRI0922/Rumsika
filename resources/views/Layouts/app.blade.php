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
</body>
</html>