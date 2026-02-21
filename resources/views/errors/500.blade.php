<!DOCTYPE html>
<html>
<head>
    <title>500 - Server Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; background:#f8fafc; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;}
        .card { text-align:center; padding:40px; background:white; border-radius:10px; box-shadow:0 5px 20px rgba(0,0,0,0.1);}
        h1 { font-size:70px; margin:0; color:#dc2626;}
        p { color:#555; }
        a { display:inline-block; margin-top:20px; padding:10px 20px; background:#111827; color:white; text-decoration:none; border-radius:5px;}
    </style>
</head>
<body>
    <div class="card">
        <h1>500</h1>
        <h3>Server Error</h3>
        <p>Something went wrong on our end. Please try again later.</p>
        <a href="{{ url('/') }}">Return Home</a>
    </div>
</body>
</html>