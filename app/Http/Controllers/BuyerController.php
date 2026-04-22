<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    /**
     * Display the Marketplace Dashboard.
     */
    public function index(Request $request) 
    {
        // 1. Fetch products (supporting optional category filters)
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

     
        $marketplaceItems = $query->latest()->get();

        // 2. Fetch the cart from the session (default to empty array)
        $cart = session()->get('cart', []);

        // 3. Return the view with items and cart data
        return view('buyer.dashboard', compact('marketplaceItems', 'cart'));
    }

    /**
     * Add an item to the shopping cart.
     */
    public function addToCart(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // If product already exists in cart, increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Add new product to cart session
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // Ensuring we store the correct image path for the preview
                "image" => $product->image_path 
            ];
        }

        session()->put('cart', $cart);
        
        // Customizing the success message for your shop
        return redirect()->back()->with('success', $product->name . ' has been added to your cart!');
    }

    /**
     * Remove an item from the cart.
     */
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from your selection.');
    }
}