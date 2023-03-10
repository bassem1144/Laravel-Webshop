<!DOCTYPE html>
<html lang="en">


<x-header></x-header>
<title>Admin Page</title>


<body>
    <x-navbar />
    <h1>Admin Page</h1>
    <a href="/create" class="btn btn-primary">Create</a>
    <x-flash-message />
    <div class="card-deck row ">
        @foreach ($products as $product)
            <div class="card" style="width:400px">
                <img class="card-img-top" src="https://picsum.photos/200/150" alt="Product image">
                <div class="card-body">
                    <h4 class="card-title">{{ $product['name'] }}</h4>
                    <p class="card-text">{{ $product['description'] }}</p>
                    <div class="row">
                        <a href="/edit/{{ $product['id'] }}" class="btn btn-primary">Edit</a>
                        <form action="/delete/{{ $product['id'] }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


</body>

</html>
