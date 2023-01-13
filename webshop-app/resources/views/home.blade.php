<!DOCTYPE html>
<html lang="en">

<x-header></x-header>
<title>Home</title>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home</a>
                <a class="nav-item nav-link" href="#">button 1</a>
                <a class="nav-item nav-link" href="#">button 2</a>
                <a class="nav-item nav-link" href="/admin">Admin Page</a>

            </div>
        </div>
    </nav>

    <div class="ml-3">

        <div class="card-deck row" style="margin-left: 200px">

            @foreach ($products as $product)
                <div class="card  m-3 col-3 h-100">
                    <img class="card-img-top" src="https://picsum.photos/200/150" alt="product image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ $product['updated_at'] }}</small>
                    </div>
                </div>
            @endforeach

        </div>

    </div>


</body>

</html>
