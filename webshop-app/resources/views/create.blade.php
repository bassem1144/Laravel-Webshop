<!DOCTYPE html>
<html lang="en">

<x-header></x-header>
<title>Create</title>

<body>
    <x-navbar />
    <h1>Create product</h1>

    <form method="POST" action="/store">
        @csrf

        <label for="name">Name</label><br><br>
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"><br><br>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="description">Description</label><br><br>
        <input type="text" name="description" placeholder="Description" value="{{ old('description') }}"><br><br>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="price">Price</label><br><br>
        <input type="text" name="price" placeholder="Price" value="{{ old('price') }}"><br><br>
        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit">create</button>
</body>

</html>
