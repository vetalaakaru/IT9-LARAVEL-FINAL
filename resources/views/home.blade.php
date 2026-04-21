<x-layout>

<section class="hero">
    <div class="hero-text">
        <h1>Essentials and Necessities,<br>Delivered to Your Door!</h1>
        <p>Shop a wide range of essential products for yourself and your family.</p>
         <a href="{{ route('chooseRole') }}" class="btn">SHOP NOW</a>
    </div>

    <div class="hero-img">
        <img src="{{ asset('images/hero.png') }}">
    </div>
</section>

<section class="categories">
    <h2>Our Top Categories</h2>

    <div class="category-grid">
        <div class="cat">Groceries</div>
        <div class="cat">Baby</div>
        <div class="cat :home">Home</div>
        <div class="cat">Health</div>
        <div class="cat">Personal</div>
    </div>

    <button class="outline-btn">View All Categories</button>
</section>

<section class="products">
    <h2>Best Sellers</h2>

    <div class="product-grid">
        @foreach($products as $product)
        <div class="card">
            <div class="heart">❤</div>

            {{-- FIXED: Changed -> to [''] to prevent "Attempt to read property on array" error --}}
            <img src="{{ asset($product['image'] ?? 'images/default.jpg') }}" alt="{{ $product['name'] }}">

            <h3>{{ $product['name'] }}</h3>
            <p>₱{{ number_format($product['price'], 2) }}</p>

            {{-- ACTION: Pointing to a generic login/role choice since cart requires auth --}}
            <form action="{{ route('chooseRole') }}" method="GET">
                <button type="submit" class="cart-btn">ADD TO CART</button>
            </form>
        </div>
        @endforeach
    </div>
</section>

<section class="promo">
    <h2>Get 50% OFF Your First Order!</h2>
    <p>Sign up today and enjoy exclusive deals.</p>
    <a href="{{ route('chooseRole') }}" class="signup-btn btn">SIGN UP NOW</a>
</section>

<style>
    .cart-btn {
        background: linear-gradient(to right, #ff7e05, #ffba08);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
        margin-top: 10px;
    }
    .cart-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(255, 126, 5, 0.3);
    }
</style>

</x-layout>