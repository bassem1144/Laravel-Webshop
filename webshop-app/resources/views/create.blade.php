<!DOCTYPE html>
<html lang="en">

<x-header></x-header>
    <title>Create</title>

<body>
    <h1>Create product</h1>
    
    <form method="POST" action="/store">
        @csrf
        <label for="name">Name</label><br><br>
        <input type="text" name="name" placeholder="Name"><br><br>
        <label for="description">Description</label><br><br>
        <input type="text" name="description" placeholder="Description"><br><br>
        <label for="price">Price</label><br><br>
        <input type="text" name="price" placeholder="Price"><br><br>
        <button type="submit">create</button>
</body>
</html>