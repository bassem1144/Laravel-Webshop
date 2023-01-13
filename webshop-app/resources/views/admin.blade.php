<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Admin Page</title>
</head>

<body>
    <div class="card-deck row ">
        @foreach ($products as $product)
            <div class="card" style="width:400px">
                <img class="card-img-top" src="https://picsum.photos/200/150" alt="Product image">
                <div class="card-body">
                    <h4 class="card-title">{{$product['name']}}</h4>
                    <p class="card-text">{{$product['description']}}</p>
                    <a href="/edit/{{$product['id']}}" class="btn btn-primary">Edit</a>
                    <a href="/delete/{{$product['id']}}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
