@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <img src="public\images\rumsika.svg" alt="" srcset="">
    <h1 class="display-1">404</h1>
    <h3>Page Not Found</h3>
    <p>The page you are looking for does not exist.</p>

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">
        Go Back Home
    </a>
</div>
@endsection