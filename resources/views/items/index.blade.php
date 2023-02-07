<h1>ItemsController</h1>

<div>
    @foreach($prekes as $product)
        Prekės kodas: {{ $product['id'] }}<br>
        Prekės pavadinimas: {{ $product['name'] }}<br>
        Kaina: {{ $product['price'] }}<br>
        <br>
    @endforeach
</div>
