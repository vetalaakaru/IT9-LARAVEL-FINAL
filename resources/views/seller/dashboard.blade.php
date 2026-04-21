<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Center | CraveCart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; background: #f4f7f6; display: flex; }
        .sidebar { width: 250px; background: #2c3e50; color: white; min-height: 100vh; padding: 20px; }
        .main-content { flex: 1; padding: 30px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .btn-add { background: #ff6b00; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
        .status-badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; }
        .status-pending { background: #ffeaa7; color: #d6a011; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>🛒 Seller Center</h2>
    <p>Welcome, {{ Auth::user()->name }}</p>
    <hr>
    <ul style="list-style: none; padding: 0;">
        <li style="padding: 10px 0;"><a href="#" style="color: white; text-decoration: none;"><i class="fas fa-box"></i> My Products</a></li>
        <li style="padding: 10px 0;"><a href="#" style="color: white; text-decoration: none;"><i class="fas fa-shopping-cart"></i> Orders</a></li>
        <li style="padding: 10px 0;"><a href="{{ route('buyer.messages') }}" style="color: white; text-decoration: none;"><i class="fas fa-comments"></i> Messages</a></li>
    </ul>
    <form action="{{ route('logout') }}" method="POST" style="margin-top: 50px;">
        @csrf
        <button type="submit" style="background: none; border: 1px solid white; color: white; cursor: pointer; width: 100%; padding: 10px;">Logout</button>
    </form>
</div>

<div class="main-content">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Inventory Management</h1>
        <button class="btn-add" onclick="document.getElementById('addModal').style.display='block'">+ Add New Product</button>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
        <div class="card"><h3>Total Orders</h3><p style="font-size: 2rem;">12</p></div>
        <div class="card"><h3>Active Products</h3><p style="font-size: 2rem;">05</p></div>
        <div class="card"><h3>Revenue</h3><p style="font-size: 2rem;">₱4,500</p></div>
    </div>

    <div class="card">
        <h3>My Items</h3>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="/images/rice.jpg" width="50" style="border-radius: 5px;"></td>
                    <td>Premium Sinandomeng</td>
                    <td>45 kgs</td>
                    <td>₱250.00</td>
                    <td>
                        <button style="border: none; background: #3498db; color: white; padding: 5px 10px; border-radius: 3px;">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="addModal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
    <div style="background: white; width: 400px; margin: 100px auto; padding: 20px; border-radius: 10px;">
        <h2>Add Product</h2>
        <form action="{{ route('seller.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Name</label><br>
            <input type="text" name="name" style="width: 100%; margin-bottom: 10px;" required><br>
            <label>Price (₱)</label><br>
            <input type="number" name="price" style="width: 100%; margin-bottom: 10px;" required><br>
            <label>Stock Quantity</label><br>
            <input type="number" name="stock" style="width: 100%; margin-bottom: 10px;" required><br>
            <label>Product Image</label><br>
            <input type="file" name="image" style="margin-bottom: 20px;"><br>
            <button type="submit" class="btn-add">Save Product</button>
            <button type="button" onclick="document.getElementById('addModal').style.display='none'" style="background: #ccc; border: none; padding: 10px;">Cancel</button>
        </form>
    </div>
</div>

</body>
</html>