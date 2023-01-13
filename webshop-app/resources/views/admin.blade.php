<!DOCTYPE html>
<html lang="en">


<x-header></x-header>
<title>Admin Page</title>


<body>
    <div class="card-deck row ">
        @foreach ($products as $product)
            <div class="card" style="width:400px">
                <img class="card-img-top" src="https://picsum.photos/200/150" alt="Product image">
                <div class="card-body">
                    <h4 class="card-title">{{ $product['name'] }}</h4>
                    <p class="card-text">{{ $product['description'] }}</p>
                    <a href="/edit/{{ $product['id'] }}" class="btn btn-primary">Edit</a>
                    <a href="/delete/{{ $product['id'] }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach

    </div>


</body>

</html>
