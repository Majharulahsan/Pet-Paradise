<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Helper function to calculate cart totals.
     * Logic: Calculates subtotal and applies shipping rule.
     */
    private function calculateCartTotals(array $cartItems)
    {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        // Shipping is 50 tk if cart is not empty, otherwise 0
        $shipping = $subtotal > 0 ? 50 : 0; 
        $grandTotal = $subtotal + $shipping;

        return compact('subtotal', 'shipping', 'grandTotal');
    }

    /**
     * Show the application home page.
     */
    public function home()
    {
        // Optional: Fetch featured products from DB for the home page
        // $featuredProducts = Product::take(4)->get();
        return view('home');
    }

    /**
     * Show the product listing page (Shop UI).
     * Fetches ALL products from the database.
     */
    public function shop()
    {
        // 1. Fetch real data from the database
        // We use paginate(12) to show 12 products per page (good for large stores)
        $products = Product::paginate(12);

        return view('shop', [
            'products' => $products
        ]);
    }

    /**
     * Show a single product detail page.
     * @param int $id The product ID.
     */
    public function productDetail($id)
    {
        // 1. Try to find the product in the database or show 404 error
        $product = Product::findOrFail($id);

        return view('product_detail', [
            'product' => $product
        ]);
    }

    /**
     * Show the checkout page.
     * Uses the 'session' cart (temporary storage until purchase).
     */
    public function checkout()
    {
        // 1. Retrieve the cart from the session
        // We REMOVED the code that auto-filled it with mock data.
        $cartItems = session('cart', []);
        
        // 2. Calculate totals
        $totals = $this->calculateCartTotals($cartItems);

        return view('checkout', array_merge([
            'cartItems' => $cartItems,
            'isCartEmpty' => empty($cartItems),
        ], $totals));
    }
    
    /**
     * Handles updating the quantity of a product in the cart.
     * (This logic mostly stays the same as it manipulates the session)
     */
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'action' => 'required|string|in:increase,decrease,remove',
        ]);

        $itemId = $validated['item_id'];
        $action = $validated['action'];
        $cart = session()->get('cart', []);
        
        $updated = false;
        $productName = "Product";

        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                $productName = $item['name'];
                
                if ($action === 'increase') {
                    $cart[$key]['quantity']++;
                    $updated = true;
                    $message = "Increased quantity of " . $productName;
                } elseif ($action === 'decrease') {
                    if ($cart[$key]['quantity'] > 1) {
                        $cart[$key]['quantity']--;
                        $updated = true;
                        $message = "Reduced quantity of " . $productName;
                    } else {
                        unset($cart[$key]);
                        $updated = true;
                        $message = "Removed " . $productName . " from cart.";
                    }
                } elseif ($action === 'remove') {
                    unset($cart[$key]);
                    $updated = true;
                    $message = "Removed " . $productName . " from cart.";
                }
                break;
            }
        }

        // Re-index and save
        $cart = array_values($cart);
        session()->put('cart', $cart);

        if ($updated) {
            return redirect()->route('checkout')->with('success', $message);
        }

        return redirect()->route('checkout')->with('error', 'Product not found in cart.');
    }
    
    /**
     * REAL Order Placement Logic
     * Saves to 'orders' and 'order_items' tables.
     */
    public function placeOrder(Request $request)
    {
        // 1. Validate Form Data
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cod,bkash,nagad,rocket',
        ]);

        // 2. Get Cart Data
        $cart = session('cart', []);
        $totals = $this->calculateCartTotals($cart);

        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        // 3. Database Transaction (Safety first: ensures both Order and Items are saved)
        try {
            DB::beginTransaction();

            // A. Create the Order Record
            $order = Order::create([
                'user_id' => Auth::id() ?? null, // Link to user if logged in, else null
                'customer_name' => $request->shipping_name,
                'customer_email' => $request->shipping_email,
                'customer_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'total_amount' => $totals['grandTotal'],
                'status' => 'pending', // Default status
            ]);

            // B. Create Order Items (Loop through cart)
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'], // Storing name snapshots is good practice
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                // Optional: Decrease stock from Product table
                // Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }

            DB::commit(); // Save everything

            // 4. Clear the Cart
            session()->forget('cart');

            // 5. Redirect to Thank You
            return redirect()->route('thankyou')->with([
                'success' => 'Order placed successfully!',
                'order_id' => $order->id,
                'grand_total' => number_format($totals['grandTotal']),
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Undo changes if something failed
            return redirect()->back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    public function thankYou()
    {
        return view('thank_you');
    }

    /**
     * Real Database Search
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return redirect()->route('shop');
        }

        // Search in Database using SQL 'LIKE'
        $results = Product::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        return view('search_results', [
            'results' => $results,
            'query' => $query,
            'hasResults' => $results->isNotEmpty(),
        ]);
    }
}