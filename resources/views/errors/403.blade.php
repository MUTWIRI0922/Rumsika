<!DOCTYPE html>
<html>
<head>
    <title>403 - Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; background:#f8fafc; display:flex; align-items:center; justify-content:center; height:100vh; margin:0;}
        .card { text-align:center; padding:40px; background:white; border-radius:10px; box-shadow:0 5px 20px rgba(0,0,0,0.1);}
        h1 { font-size:70px; margin:0; color:#f59e0b;}
        p { color:#555; }
        a { display:inline-block; margin-top:20px; padding:10px 20px; background:#111827; color:white; text-decoration:none; border-radius:5px;}
    </style>
</head>
<body>
    <div class="card">
        <h1>403</h1>
        <h3>Access Denied</h3>
        <p>You don’t have permission to access this resource.</p>
        <a href="{{ url('/') }}">Go Home</a>
    </div>
</body>
</html>