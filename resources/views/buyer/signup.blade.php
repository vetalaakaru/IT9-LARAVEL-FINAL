<x-layout>
<section class="auth-section" style="background: linear-gradient(135deg, #ff6b00, #ff8e3c); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="form-box" style="background: white; padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; text-align: center;">
        <h2 style="margin-bottom: 25px; font-weight: 800;">Buyer Signup</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="buyer">

            <input type="text" name="name" placeholder="Full Name" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px;">
            <input type="email" name="email" placeholder="Email" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px;">
            <input type="password" name="password" placeholder="Password" style="width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px;">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">

            <button type="submit" style="width: 100%; background: #ff6b00; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer;">SIGN UP</button>
        </form>
    </div>
</section>
</x-layout>