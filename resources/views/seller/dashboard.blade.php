<x-layout>
<div style="display: flex; min-height: 100vh; background: #f3e3eb; font-family: 'Poppins', sans-serif;">
    
    <aside style="width: 280px; background: #ff4a00; color: white; padding: 40px 20px; position: fixed; height: 100vh;">
        <h2 style="font-family: serif; text-align: center; font-size: 2rem; margin-bottom: 40px;">CraveCart</h2>
        <nav style="display: flex; flex-direction: column; gap: 10px;">
            <button onclick="show('products')" id="nav-products" class="nav-link active">Inventory</button>
            <button onclick="show('orders')" id="nav-orders" class="nav-link">Orders</button>
            <button onclick="show('messages')" id="nav-messages" class="nav-link">Messages</button>
        </nav>
    </aside>

    <main style="flex: 1; margin-left: 280px; padding: 40px;">
        <section id="sec-products" class="tab-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="color: #dd0d22; margin: 0;">My Products</h1>
                <button onclick="openAddModal()" style="background: #dd0d22; color: white; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: bold;">+ Add Product</button>
            </div>

            <div style="background: white; border-radius: 20px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="text-align: left; border-bottom: 2px solid #f3e3eb; color: #ff4a00;">
                        <th style="padding: 15px;">Item</th>
                        <th style="padding: 15px;">Price</th>
                        <th style="padding: 15px;">Category</th>
                        <th style="padding: 15px; text-align: center;">Actions</th>
                    </tr>
                    @foreach($products as $product)
                    <tr style="border-bottom: 1px solid #f3e3eb;">
                        <td style="padding: 15px;">{{ $product->name }}</td>
                        <td style="padding: 15px; font-weight: bold; color: #dd0d22;">₱{{ number_format($product->price, 2) }}</td>
                        <td style="padding: 15px;">{{ $product->category }}</td>
                        <td style="padding: 15px; text-align: center; display: flex; justify-content: center; gap: 10px;">
                            <button onclick="openEditModal({{ $product }})" style="background: none; border: none; color: #3498db; cursor: pointer;"><i class="fas fa-edit"></i></button>
                            
                            <form action="{{ route('seller.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ff4a00; cursor: pointer;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </section>
    </main>
</div>

<div id="addModal" class="modal-bg">
    <div class="modal-content">
        <h2 style="color: #dd0d22;">New Essential Item</h2>
        <form action="{{ route('seller.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Product Name" class="form-input" required>
            <input type="number" name="price" placeholder="Price" class="form-input" required>
            <select name="category" class="form-input">
                <option>Groceries</option>
                <option>Household</option>
                <option>Personal Care</option>
            </select>
            <input type="file" name="image" style="margin-bottom: 20px;">
            <div style="display:flex; gap:10px;">
                <button type="submit" style="flex:2; background: #dd0d22; color: white; padding: 15px; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">Save</button>
                <button type="button" onclick="closeModal('addModal')" style="flex:1; background: #eee; padding: 15px; border-radius: 10px; border:none; cursor:pointer;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal-bg">
    <div class="modal-content">
        <h2 style="color: #dd0d22;">Edit Product</h2>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf @method('POST') <input type="text" name="name" id="edit_name" class="form-input" required>
            <input type="number" name="price" id="edit_price" class="form-input" required>
            <select name="category" id="edit_category" class="form-input">
                <option>Groceries</option>
                <option>Household</option>
                <option>Personal Care</option>
            </select>
            <input type="file" name="image" style="margin-bottom: 20px;">
            <div style="display:flex; gap:10px;">
                <button type="submit" style="flex:2; background: #3498db; color: white; padding: 15px; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">Update</button>
                <button type="button" onclick="closeModal('editModal')" style="flex:1; background: #eee; padding: 15px; border-radius: 10px; border:none; cursor:pointer;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    .modal-bg { display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 100; }
    .modal-content { background: white; padding: 40px; border-radius: 20px; width: 400px; }
    .form-input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 10px; box-sizing: border-box; }
    .nav-link { background: none; border: none; color: white; text-align: left; padding: 15px; border-radius: 10px; cursor: pointer; font-size: 1rem; opacity: 0.7; width: 100%; }
    .nav-link.active { background: #dd0d22; opacity: 1; font-weight: bold; }
</style>

<script>
    function show(id) {
        document.querySelectorAll('.tab-content').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));
        document.getElementById('sec-' + id).style.display = 'block';
        document.getElementById('nav-' + id).classList.add('active');
    }

    function openAddModal() { document.getElementById('addModal').style.display = 'flex'; }

    function openEditModal(product) {
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_category').value = product.category;
        
        // Update the form action URL dynamically
        const form = document.getElementById('editForm');
        form.action = `/seller/product/update/${product.id}`;
        
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
</script>
</x-layout>