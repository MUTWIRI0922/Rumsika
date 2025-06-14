<style>
    .navbar {
        box-shadow: 1px 1px 6px grey;
        width: 100%;
        position: fixed;
        z-index: 1000;
    }
    .navbar img {
        width: 200px;
        max-width: 40vw;
    }
    @media (max-width: 576px) {
        .navbar img {
            width: 60px !important;
            max-width: 20vw !important;
        }
        .navbar .form-control,
        .navbar .btn {
            font-size: 0.85rem;
            padding: 0.25rem 0.5rem;
        }
        .navbar form {
            width: 45vw !important;
            min-width: 0;
            margin: 0 0.5rem;
        }
        .navbar a {
            font-size: 0.9rem;
            margin: 0 0.3rem !important;
        }
    }
</style>
<div class="nav pb-4">
    <nav>
        <div class="navbar navbar-light bg-light d-flex flex-row align-items-center justify-content-between flex-nowrap">
            <a href="{{ url('') }}" class="ms-2 me-2">
                <img class="img-fluid" src="{{ asset('images/rumsika.svg') }}" alt="logo">
            </a>
            <form action="javascript:void(0);" class="d-flex align-items-center mx-2" style="width:40vw; min-width:90px;">
                <input type="text" id="searchInput" class="form-control me-2" placeholder="search">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
            <a href="{{ url('Landlord-login') }}" class="ms-2 me-2" style="text-decoration:none; white-space:nowrap;">Lease/sell</a>
        </div>
    </nav>
</div>

