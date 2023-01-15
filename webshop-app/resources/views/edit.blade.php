<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
</head>
<body>
    <h1>Edit: {{ $product['name'] }}</h1>

    <form  method="POST" action="/update/{{$product['id']}}">
        @csrf
        @method('PUT')
        <label for="name">Name</label><br><br>
        <input type="text" name="name" value="{{ $product['name'] }}" placeholder="Name"><br><br>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description</label><br><br>
        <input type="text" name="description" value="{{ $product['description'] }}" placeholder="Description"><br><br>
        <label for="price">Price</label><br><br>
        <input type="text" name="price" value="{{ $product['price'] }}" placeholder="Price"><br><br>
        <button type="submit">edit</button>
    </form>
    
</body>
</html>