<x-layout>
<section class="dashboard-container" style="background-color: #fff5f0; min-height: 100vh; padding: 20px; font-family: 'Poppins', sans-serif;">
    
    {{-- Success Message Notification --}}
    @if(session('success'))
        <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 12px; margin-bottom: 20px; text-align: center; font-weight: 600; box-shadow: 0 4px 10px rgba(46, 204, 113, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    {{-- Top Banner --}}
    <div class="welcome-banner" style="background: linear-gradient(135deg, #ff6b00, #ff8e3c); color: white; padding: 30px; border-radius: 20px; margin-bottom: 30px; box-shadow: 0 10px 20px rgba(255, 107, 0, 0.1);">
        <h2 style="margin:0; font-weight: 800;">Welcome, {{ Auth::user()->name }}! 🛍️</h2>
        <p style="margin: 5px 0 0; opacity: 0.9;">The best deals are waiting for you.</p>
    </div>

    <div class="dashboard-grid" style="display: grid; grid-template-columns: 3fr 1fr; gap: 25px;">
        
        {{-- Main Marketplace Grid --}}
        <div class="main-content">
            <h3 style="color: #333; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px;">Marketplace</h3>

            <div class="items-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 20px;">
                @forelse($marketplaceItems as $product)
                <div class="product-card" style="background: white; border-radius: 20px; border: 1px solid #f0f0f0; overflow: hidden; transition: 0.3s; position: relative;">
                    
                    {{-- Product Image Section --}}
                    <div style="height: 180px; background: #fdfdfd; display: flex; align-items: center; justify-content: center; padding: 15px;">
                        @if($product->image_path)
                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        @else
                            <span style="font-size: 3rem;">📦</span>
                        @endif
                        <div style="position: absolute; top: 15px; right: 15px; color: #ff6b00; cursor: pointer;">❤️</div>
                    </div>

                    {{-- Product Info (Shop/Brand Removed) --}}
                    <div style="padding: 20px;">
                        <h4 style="margin: 0 0 15px; color: #333; font-size: 1.1rem; height: 2.4em; overflow: hidden; line-height: 1.2; font-weight: 600;">
                            {{ $product->name }}
                        </h4>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                            <span style="font-weight: 800; font-size: 1.3rem; color: #ff6b00;">₱{{ number_format($product->price, 2) }}</span>
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="buy-btn" style="background: #333; color: white; border: none; padding: 10px 18px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s;">
                                    BUY +
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: span 3; text-align: center; padding: 50px; color: #aaa;">
                    <p>No products available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Sidebar: Cart Preview --}}
        <aside class="sidebar">
            <div class="cart-box" style="background: white; padding: 25px; border-radius: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.02); position: sticky; top: 20px;">
                <h4 style="margin: 0 0 20px 0; border-bottom: 2px solid #fff5f0; padding-bottom: 10px;">🛒 Your Cart</h4>
                
                @php $total = 0; @endphp
                @if(count((array)$cart) > 0)
                    <div style="max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
                        @foreach($cart as $id => $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.85rem; border-bottom: 1px solid #f9f9f9; padding-bottom: 8px;">
                                <div>
                                    <strong style="display: block; color: #333;">{{ $item['name'] }}</strong>
                                    <span style="color: #888;">Qty: {{ $item['quantity'] }}</span>
                                </div>
                                <span style="font-weight: 700; color: #333;">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; font-weight: 800; font-size: 1.1rem; margin-bottom: 20px; color: #ff6b00;">
                        <span>Total:</span>
                        <span>₱{{ number_format($total, 2) }}</span>
                    </div>

                    <button style="width: 100%; background: #ff6b00; color: white; border: none; padding: 15px; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='#e66000'" onmouseout="this.style.backgroundColor='#ff6b00'">
                        CHECKOUT
                    </button>
                @else
                    <div style="text-align: center; padding: 30px 0;">
                        <span style="font-size: 3rem; opacity: 0.2;">🛒</span>
                        <p style="color: #aaa; margin-top: 10px;">Cart is currently empty</p>
                    </div>
                @endif
            </div>
        </aside>
    </div>
</section>

<style>
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255,107,0,0.15);
    }
    .buy-btn:hover {
        background: #ff6b00 !important;
        transform: scale(1.05);
    }
</style>
</x-layout>