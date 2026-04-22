<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Your model for flower arrangements
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    // Display the main Seller Dashboard
    public function index()
    {
        // 1. PRODUCTS: Fetching dynamic flower listings
        $products = Product::latest()->get();

        // 2. ORDERS: Example placeholder for order logic
        $orders = [
            ['id' => 'EXP-001', 'customer' => 'Juan Dela Cruz', 'status' => 'Pending', 'total' => 1500.00],
            ['id' => 'EXP-002', 'customer' => 'Maria Clara', 'status' => 'Delivered', 'total' => 2200.00],
        ];

        // 3. MESSAGES: Example placeholder for inquiries
        $messages = [
            ['sender' => 'Liza Soberano', 'text' => 'Is the Tulip set available for delivery today?'],
        ];

        return view('seller.dashboard', compact('products', 'orders', 'messages'));
    }

    // Function to save new flower arrangements
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Arrangement added to Espiflor Shop!');
    }
}