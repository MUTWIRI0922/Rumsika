

<style>
    .navbar{
        box-shadow: 3px 3px 5px grey;
        width: 100%;
        position: fixed;
    }
    .navbar img{
        width: 60vw !important;
        max-width: 200px;
    }
    
</style>
    <div class="nav pb-4">
        <nav>
            <div class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
                <a href="{{ url('') }}" class="ms-4 me-5"><img class="img-fluid " style=" width:25%; height:auto;" src="{{ asset('images/rumsika.svg') }}" alt="logo"></a> 
            
            <form action="" class=" d-flex ml-3 mx-4" style="width:40%;">
                <input type="text" name="" id="" class="form-control me-2" placeholder="search">
                <button type="submit" class="btn btn-success">Search</button>
            </form>
            <span class="glyphicon glyphicon-search"></span>

            <a href="{{ url('Landlord-login') }}" class=" ms-4 me-4"  style="margin-right: 5%; text-decoration:none;">Lease/sell</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
            </button>

        </nav>
    </div>

