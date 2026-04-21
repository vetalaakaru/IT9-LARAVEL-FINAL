<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CraveCart</title>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <a href="{{ route('home') }}" class="cravecartlogo">
            <h2>🛒 CraveCart</h2>
        </a>
    </div>

    <ul>
        <li><a href="{{ route('shop') }}">Shop</a></li>
        <li><a href="{{ route('bestsellers') }}">Best Sellers</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>

    <div class="nav-right" style="display: flex; align-items: center; gap: 15px;">
        <div class="search-container">
            <input type="text" placeholder="Search for essentials..." style="padding: 8px 15px; border-radius: 20px; border: 1px solid #ddd;">
        </div>
        
        @auth
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="color: #333; font-weight: 600;">Hi, {{ Auth::user()->name }}!</span>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="login-btn authpart" style="background: #111; color: #ff6b00; border: 1px solid #ff6b00;">Admin Panel</a>
                @elseif(Auth::user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}" class="login-btn authpart">Seller Center</a>
                @else
                    <a href="{{ route('buyer.dashboard') }}" class="login-btn authpart">Dashboard</a>
                    <a href="{{ route('buyer.messages') }}" class="login-btn authpart"><i class="fa-regular fa-comment"></i></a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="signup-btn authpart" style="border: none; cursor: pointer; padding: 8px 15px; border-radius: 5px; background: #ff6b00; color: white;">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('chooseRole') }}" class="login-btn authpart">Login</a>
            <a href="{{ route('chooseRole') }}" class="signup-btn authpart">Sign up</a>
        @endauth
    </div>
</nav>

<main>
    @if(session('success'))
        <div style="background: #2ecc71; color: white; padding: 15px; text-align: center; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #e74c3c; color: white; padding: 15px; text-align: center; font-weight: bold;">
            {{ session('error') }}
        </div>
    @endif

    {{ $slot }}
</main>

<footer class="footer" style="margin-top: 50px; padding: 40px 20px; background: #f9f9f9; text-align: center; border-top: 1px solid #eee;">
    <div style="display: flex; justify-content: center; gap: 30px; margin-bottom: 20px;">
        <a href="{{ route('about') }}" style="color: #666; text-decoration: none;">About</a>
        <a href="{{ route('contact') }}" style="color: #666; text-decoration: none;">Contact</a>
        @guest
            <a href="{{ route('seller.signup') }}" style="color: #ff6b00; text-decoration: none; font-weight: bold;">Sell on CraveCart</a>
        @endguest
    </div>
    <div class="footer-bottom">
        <p style="color: #999; font-size: 0.9rem;">© {{ date('Y') }} CraveCart by Group 1. All rights reserved.</p>
    </div>
</footer>
</body>
</html>