<x-layout>
<style>
    .page-container { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
    .page-title { 
        font-size: 3.5rem; 
        font-weight: 900; 
        text-transform: uppercase; 
        font-style: italic; 
        margin-bottom: 2.5rem; 
        color: #000; 
        letter-spacing: -2px;
    }
    
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
        gap: 35px; 
    }

    .card { 
        background: white; 
        border: 4px solid black; 
        padding: 2rem; 
        border-radius: 2rem; 
        position: relative;
        box-shadow: 12px 12px 0px 0px rgba(0,0,0,1);
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card:hover { 
        transform: translate(-8px, -8px); 
        box-shadow: 20px 20px 0px 0px rgba(0,0,0,1);
    }

    .heart { position: absolute; top: 25px; right: 25px; font-size: 1.8rem; cursor: pointer; transition: 0.2s; }
    .heart:hover { transform: scale(1.2); }
    
    .product-img-container {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        background: #f0f0f0;
        border-radius: 1.5rem;
        border: 3px solid black;
    }

    .card h3 { font-weight: 900; font-size: 1.75rem; margin-top: 1rem; color: #000; }
    .card p { font-weight: 900; color: #dd0d22; font-size: 1.5rem; margin-bottom: 2rem; }

    .cart-btn {
        display: block;
        width: 100%;
        background: black;
        color: white;
        padding: 15px;
        border-radius: 1.2rem;
        font-weight: 900;
        text-transform: uppercase;
        text-decoration: none;
        text-align: center;
        border: 3px solid black;
        transition: all 0.2s;
        font-size: 1.1rem;
    }

    .cart-btn:hover { 
        background: #dd0d22; 
        color: white;
        border-color: #dd0d22;
    }
</style>

<div class="page-container">
    <h1 class="page-title">Best Sellers</h1>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="card">
                <span class="heart">❤️</span>
                
                <div class="product-img-container">
                    <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" style="max-width: 100px; max-height: 100%;">
                </div>

                <h3>{{ $product['name'] }}</h3>
                <p>₱{{ number_format($product['price'], 2) }}</p>
                
                <a href="{{ route('buyer.messages', ['id' => 0]) }}?item={{ urlencode($product['name']) }}" class="cart-btn">
                    Negotiate / Buy
                </a>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 50px; border: 4px dashed black; border-radius: 2rem;">
                <h2 style="font-weight: 900;">NO BEST SELLERS FOUND</h2>
            </div>
        @endforelse
    </div>
</div>
</x-layout>