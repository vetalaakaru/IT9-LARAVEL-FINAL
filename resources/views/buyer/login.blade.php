<x-layout>

<section class="auth-section">
    <div class="form-box">
        <h2>Buyer Login</h2>
        <p>Welcome back! Please enter your details.</p>

        @if ($errors->any())
            <div style="background: #ffebee; color: #c62828; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                <ul style="list-style: none; margin: 0; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required value="{{ old('email') }}">
            </div>

            <div class="input-group" style="margin-top: 15px;">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn" style="width: 100%; margin-top: 20px; background: linear-gradient(to right, #ff7e05, #ffba08); border: none; color: white; padding: 12px; border-radius: 50px; font-weight: 700; cursor: pointer;">
                LOGIN
            </button>
        </form>

        <div class="form-footer" style="margin-top: 20px; text-align: center;">
            <p>Don't have an account? <a href="{{ route('buyer.signup') }}" style="color: #ff7e05; font-weight: 600;">Sign up here</a></p>
        </div>
    </div>
</section>

<style>
    .auth-section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
        padding: 40px 20px;
    }
    .form-box {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }
    .input-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }
    .input-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
    }
    .input-group input:focus {
        border-color: #ff7e05;
        outline: none;
    }
</style>

</x-layout>