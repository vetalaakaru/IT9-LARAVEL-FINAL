<x-layout>
<section class="role-choose">
    <div class="form-box">
        <h2 style="font-family: 'Poppins', sans-serif; font-weight: 800; text-transform: uppercase;">Choose Your Role</h2>

        <div class="role-buttons">
            {{-- Correct Buyer Route --}}
            <a href="{{ route('buyer.login') }}" class="btn role-btn buyer">
                Login as Buyer
            </a>

            {{-- Correct Seller Route --}}
            <a href="{{ route('seller.signup') }}" class="btn role-btn seller">
                Apply as Seller
            </a>

            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            
            {{-- Correct Admin Route - Points to Dashboard (Auth Middleware handles the rest) --}}
            <a href="{{ route('admin.dashboard') }}" class="btn role-btn admin" style="background: #111; color: #ff6b00; border: 1px solid #ff6b00; text-decoration: none; display: block; padding: 15px; border-radius: 10px; font-weight: 700;">
                System Administrator
            </a>
        </div>
    </div>
</section>

<style>
    .role-choose { display: flex; justify-content: center; align-items: center; min-height: 80vh; }
    .form-box { background: white; padding: 40px; border-radius: 20px; border: 4px solid black; box-shadow: 10px 10px 0px 0px #000; text-align: center; width: 100%; max-width: 400px; }
    .role-buttons { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
    .role-btn { padding: 15px; border-radius: 10px; font-weight: 700; text-transform: uppercase; text-decoration: none; transition: 0.2s; border: 3px solid black; }
    
    .buyer { background: #dd0d22; color: white; }
    .seller { background: #000; color: white; }
    
    .role-btn.admin:hover {
        background: #ff6b00 !important;
        color: white !important;
    }
</style>
</x-layout>