<!DOCTYPE html>
<html lang="en">

<x-header></x-header>
<title>Home</title>

<body>
    
    <x-navbar />

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
