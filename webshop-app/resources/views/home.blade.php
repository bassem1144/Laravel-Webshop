<h1> home page </h1>
<h2> products </h2>

@foreach ($products as $product )
    <h3> {{ $product['name'] }} </h3>
    <p> {{ $product['description'] }} </p>
    <p> {{ $product['price'] }} </p>
@endforeach