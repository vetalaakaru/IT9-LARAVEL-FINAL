<x-layout>
<style>
    .admin-body {
        background-color: #111111;
        min-height: 100vh;
        color: #ffffff;
        font-amily: 'Inter', sans-serif;
        padding: 40px;
    }
    .stat-card {
        background: #1c1c1c;
        border-radius: 24px;
        padding: 40px;
        position: relative;
        overflow: hidden;
        border: 1px solid #2a2a2a;
    }
    .stat-label { color: #FF6B00; font-weight: 800; letter-spacing: 1px; font-size: 0.9rem; }
    .stat-value { font-size: 5rem; font-weight: 900; line-height: 1; margin: 10px 0; }
    .stat-bg-num {
        position: absolute; right: 20px; bottom: -10px;
        font-size: 8rem; font-weight: 900; color: #222222; z-index: 0;
    }
    .alert-banner {
        background: linear-gradient(90deg, rgba(255,107,0,0.1) 0%, rgba(255,107,0,0) 100%);
        border: 1px solid #FF6B00;
        border-radius: 50px;
        padding: 15px 30px;
        margin: 30px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .verify-table {
        width: 100%; border-collapse: separate; border-spacing: 0 10px;
    }
    .verify-table tr { background: #1c1c1c; }
    .verify-table td, .verify-table th { padding: 20px; }
    .verify-table th { color: #888; font-weight: 400; text-align: left; }
    .btn-approve {
        background: #FF6B00; color: white; border: none; padding: 10px 25px;
        border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;
    }
    .btn-approve:hover { background: #e65a00; transform: translateY(-2px); }
</style>

<div class="admin-body">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div>
            <h5 style="color: #FF6B00; margin: 0;">SYSTEM OVERVIEW</h5>
            <h1 style="font-size: 3rem; margin: 5px 0;">Dashboard</h1>
            <p style="color: #666;">Managing <span style="color: #eee;">CraveCart</span> ecosystem.</p>
        </div>
        <div style="text-align: right;">
            <div style="font-weight: 800; letter-spacing: 1px;">ADMINISTRATOR</div>
            <div style="color: #FF6B00; font-size: 0.8rem;">ROOT ACCESS</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 40px;">
        <div class="stat-card">
            <div class="stat-label">VERIFIED SELLERS</div>
            <div class="stat-value">{{ $verifiedSellersCount }}</div>
            <div style="color: #666;">+{{ $pendingCount }} PENDING APPROVAL</div>
            <div class="stat-bg-num">01</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">VERIFIED BUYERS</div>
            <div class="stat-value">{{ $verifiedBuyersCount }}</div>
            <div style="color: #2ecc71;">SAFE COMMUNITY • ACTIVE</div>
            <div class="stat-bg-num">02</div>
        </div>
    </div>

    @if($pendingCount > 0)
    <div class="alert-banner">
        <span style="font-style: italic; font-weight: 500;">User verification requires your immediate review.</span>
        <a href="#requests" class="btn-approve" style="text-decoration: none; font-size: 0.8rem;">VERIFY NOW</a>
    </div>
    @endif

    <div id="requests" style="margin-top: 50px;">
        <h3 style="margin-bottom: 20px;">Pending Verifications</h3>
        <table class="verify-table">
            <thead>
                <tr>
                    <th>USER / SHOP</th>
                    <th>DOCUMENTATION</th>
                    <th>DATE SUBMITTED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingUsers as $user)
                <tr>
                    <td style="border-radius: 15px 0 0 15px;">
                        <div style="font-weight: bold;">{{ $user->owner_name ?? $user->name }}</div>
                        <div style="color: #FF6B00; font-size: 0.85rem;">{{ $user->shop_name ?? 'Individual Buyer' }}</div>
                    </td>
                    <td>
                        <a href="{{ asset('storage/' . $user->valid_id) }}" target="_blank" style="color: #888; text-decoration: none;">
                            <i class="fas fa-file-alt"></i> View ID Document
                        </a>
                    </td>
                    <td style="color: #666;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="border-radius: 0 15px 15px 0;">
                        <div style="display: flex; gap: 10px;">
                            <form action="{{ route('admin.approve', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-approve">APPROVE</button>
                            </form>
                            
                            <form action="{{ route('admin.reject', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: transparent; border: 1px solid #444; color: #888; padding: 10px 20px; border-radius: 8px; cursor: pointer;">REJECT</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #444; padding: 50px; border-radius: 15px;">
                        No pending requests at this time.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-layout>