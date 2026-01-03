<!DOCTYPE html>
<html lang="en">

<x-header></x-header>
<title>Edit</title>

<body>
    <x-navbar />
    <h1>Edit: {{ $product['name'] }}</h1>

    <form method="POST" action="/update/{{ $product['id'] }}">
        @csrf
        @method('PUT')
        <label for="name">Name</label><br><br>
        <input type="text" name="name" value="{{ $product['name'] }}" placeholder="Name"><br><br>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="description">Description</label><br><br>
        <input type="text" name="description" value="{{ $product['description'] }}"
            placeholder="Description"><br><br>
        <label for="price">Price</label><br><br>
        <input type="text" name="price" value="{{ $product['price'] }}" placeholder="Price"><br><br>

        <label for="stock">Stock</label><br><br>
        <input type="number" name="stock" value="{{ $product['stock'] }}" placeholder="Stock"><br><br>

        <label for="category_id">Category</label><br><br>
        <select name="category_id" id="category_id">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">edit</button>
    </form>

</body>

</html>
