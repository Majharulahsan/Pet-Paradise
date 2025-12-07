<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class ProductController extends Controller
{
    /**
     * Mock product data for demonstration.
     */
    private $products = [
        [
            'id' => 1,
            'name' => 'Premium Dog Food (15kg)',
            'price' => 5999,
            'category' => 'Food & Nutrition',
            'image' => 'https://images.unsplash.com/photo-1520721973443-8f2bfd949b19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwZXQlMjBzdXBwbGllc3xlbnwxfHx8fDE3NjA1MjE0NTl8MA&lib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 4,
            'reviews' => 124,
            'description' => 'Our Premium Dog Food is specially formulated with high-quality ingredients to provide complete and balanced nutrition for your furry friend. Made with real chicken as the first ingredient, this nutrient-rich formula supports healthy digestion, strong muscles, and a shiny coat. Perfect for adult dogs of all breeds.',
            'stock' => 45,
        ],
        [
            'id' => 2,
            'name' => 'Interactive Cat Toy',
            'price' => 899,
            'category' => 'Toys',
            'image' => 'https://images.unsplash.com/photo-1517435272648-b4b3c4f74d0a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxDYXQlMjBUb3l8ZW58MXx8fHwxNzYwNTM2NTk0fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 5,
            'reviews' => 54,
            'description' => 'Keep your feline friend entertained for hours with this electronic interactive cat toy. It features unpredictable movements and feathered attachments to stimulate your cat\'s hunting instincts. Durable and safe for all ages.',
            'stock' => 20,
        ],
        [
            'id' => 3,
            'name' => 'Soft Pet Bed (Large)',
            'price' => 3500,
            'category' => 'Accessories',
            'image' => 'https://images.unsplash.com/photo-1534723447950-c20e2e987c6b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxQZXRCRWR8ZW58MXx8fHwxNzYwNTM2NjU3fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
            'rating' => 4,
            'reviews' => 88,
            'description' => 'A large, plush bed providing maximum comfort and support for large breed dogs or multiple cats. The cover is removable and machine washable for easy cleaning. Non-slip base keeps the bed securely in place.',
            'stock' => 10,
        ],
    ];

    /**
     * Helper function to calculate cart totals.
     */
    private function calculateCartTotals(array $cartItems)
    {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        // **MODIFICATION: Shipping cost is always 50 tk (if cart is not empty)**
        // Original: $shipping = $subtotal > 0 ? 100 : 0; 
        $shipping = $subtotal > 0 ? 50 : 0; 
        $grandTotal = $subtotal + $shipping;

        return compact('subtotal', 'shipping', 'grandTotal');
    }

    /**
     * Show the application home page (Hero UI).
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Show the product listing page (Shop UI).
     */
    public function shop()
    {
        // Pass the mock product list to the shop view
        return view('shop', [
            'products' => $this->products
        ]);
    }

    /**
     * Show a single product detail page (Product Detail UI).
     * @param int $id The product ID.
     */
    public function productDetail($id)
    {
        // Find the product by ID. Use strict type check for consistency.
        $product = collect($this->products)->firstWhere('id', (int)$id);

        if (!$product) {
            abort(404, 'Product not found.');
        }

        return view('product_detail', [
            'product' => $product
        ]);
    }

    /**
     * Show the checkout page.
     */
    public function checkout()
    {
        // Use a persistent cart in the session for testing
        $mockCartItems = session()->get('cart', [
            [
                'id' => 1, 
                'name' => 'Premium Dog Food (15kg)', 
                'price' => 5999, 
                'quantity' => 1, 
                'image' => 'https://images.unsplash.com/photo-1520721973443-8f2bfd949b19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwZXQlMjBzdXBwbGllc3xlbnwxfHx8fDE3NjA1MjE0NTl8MA&lib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral'
            ],
            [
                'id' => 2, 
                'name' => 'Interactive Cat Toy', 
                'price' => 899, 
                'quantity' => 3, 
                'image' => 'https://images.unsplash.com/photo-1517435272648-b4b3c4f74d0a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxDYXQlMjBUb3l8ZW58MXx8fHwxNzYwNTM2NTk0fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral'
            ]
        ]);
        
        // Save the initial mock cart to the session if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', $mockCartItems);
        }

        $cartItems = session('cart');
        $totals = $this->calculateCartTotals($cartItems);

        return view('checkout', array_merge([
            'cartItems' => $cartItems,
            'isCartEmpty' => empty($cartItems),
        ], $totals));
    }
    
    /**
     * Handles updating the quantity of a product in the cart.
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

        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                if ($action === 'increase') {
                    $cart[$key]['quantity']++;
                    $updated = true;
                    $message = "Increased quantity of " . $item['name'] . ".";
                } elseif ($action === 'decrease') {
                    if ($cart[$key]['quantity'] > 1) {
                        $cart[$key]['quantity']--;
                        $updated = true;
                        $message = "Reduced quantity of " . $item['name'] . ".";
                    } else {
                        // If quantity is 1 and they decrease, remove it.
                        unset($cart[$key]);
                        $updated = true;
                        $message = "Removed " . $item['name'] . " from cart.";
                    }
                } elseif ($action === 'remove') {
                    unset($cart[$key]);
                    $updated = true;
                    $message = "Removed " . $item['name'] . " from cart.";
                }
                break;
            }
        }

        // Re-index the array after removal
        $cart = array_values($cart);
        session()->put('cart', $cart);

        if ($updated) {
            return redirect()->route('checkout')->with('success', $message);
        }

        return redirect()->route('checkout')->with('error', 'Product not found in cart.');
    }
    
    /**
     * Placeholder for the final order placement.
     */
  // In app/Http/Controllers/ProductController.php

public function placeOrder(Request $request)
{
    // Simple validation placeholder
    $request->validate([
        'shipping_name' => 'required',
        'shipping_email' => 'required|email',
        'shipping_phone' => 'required',
        'shipping_address' => 'required',
        'payment_method' => 'required|in:cod,bkash,nagad,rocket',
    ]);

    // Mock Order Processing
    $cart = session()->pull('cart', []); // Clear the cart after order
    $totals = $this->calculateCartTotals($cart);
    
    if (empty($cart)) {
        return redirect()->route('checkout')->with('error', 'Your cart is empty. Cannot place order.');
    }

    // Mock Order Confirmation
    $orderId = 'ORDER-' . time();
    $total = number_format($totals['grandTotal']);
    $method = strtoupper($request->payment_method);

    // 🌟 THE FIX IS HERE 🌟
    // Change the redirect destination to the 'thankyou' route
    return redirect()->route('thankyou')->with([
        'success' => "Order **{$orderId}** placed successfully! Total amount: ৳{$total}. Payment method: {$method}.",
        // Optionally pass order data to the thankYou view
        'order_id' => $orderId,
        'grand_total' => $total,
    ]);
}

public function thankYou()
{
    // Make sure you have created the view file resources/views/thankyou.blade.php
    return view('thank_you');
}

public function search(Request $request)
{
    // Get the search term from the URL query string (e.g., ?query=dog)
    $query = $request->input('query');
    
    // Convert the term to lowercase for case-insensitive searching
    $searchTerm = strtolower($query);

    // Filter products from the mock data array
    $results = collect($this->products)->filter(function ($product) use ($searchTerm) {
        $name = strtolower($product['name']);
        $category = strtolower($product['category']);
        
        // Match if the search term is found in the product name OR category
        return str_contains($name, $searchTerm) || str_contains($category, $searchTerm);
    })->values(); // Reset array keys after filtering

    // Pass the results and the original query to a new view
    return view('search_results', [
        'results' => $results,
        'query' => $query,
        'hasResults' => $results->isNotEmpty(),
    ]);
}


}