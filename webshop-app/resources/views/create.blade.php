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

        <label for="stock">Stock</label><br><br>
        <input type="number" name="stock" placeholder="Stock" value="{{ old('stock') }}"><br><br>
        @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="category_id">Category</label><br><br>
        <select name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>
        @error('category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit">create</button>
</body>

</html>
