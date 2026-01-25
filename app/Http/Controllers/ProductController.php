<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    private $projectId;
    private $firestoreUrl;
    private $apiKey;

    public function __construct()
    {
        $this->projectId = config('firebase.project_id');
        $this->firestoreUrl = config('firebase.firestore.url');
        $this->apiKey = config('firebase.api_key');

        // Debug: Log configuration
        \Log::info('Firebase Config:', [
            'projectId' => $this->projectId,
            'firestoreUrl' => $this->firestoreUrl,
            'apiKey' => substr($this->apiKey, 0, 10) . '...' // Log partial key for security
        ]);
    }

    private function getAuthToken()
    {
        // For Firestore REST API, we need authentication
        // For now, we'll try without auth (may work for reading public data)
        // To add auth, you'd need to implement OAuth2 flow with service account
        return null;
    }

    private function getProductsFromFirestore()
    {
        // Cache products for 5 minutes to improve performance
        return Cache::remember('firestore_products', 300, function () {
            try {
                $url = "{$this->firestoreUrl}/products?key={$this->apiKey}";
                $response = Http::timeout(10)->get($url); // Add 10 second timeout

                // Debug: Log the response for troubleshooting
                \Log::info('Firestore Get Products Response:', [
                    'url' => $url,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $products = [];

                    if (isset($data['documents'])) {
                        foreach ($data['documents'] as $doc) {
                            $product = $this->convertFirestoreDocument($doc);
                            $products[] = $product;
                        }
                    }

                    return $products;
                }

                // If Firestore fails, fallback to local database
                return Product::all()->map(function($product) {
                    return $product->toArray();
                })->toArray();

            } catch (\Exception $e) {
                // Fallback to local database
                return Product::all()->map(function($product) {
                    return $product->toArray();
                })->toArray();
            }
        });
    }

    private function convertFirestoreDocument($doc)
    {
        $product = [];
        if (isset($doc['fields'])) {
            foreach ($doc['fields'] as $key => $value) {
                if (isset($value['stringValue'])) {
                    $product[$key] = $value['stringValue'];
                } elseif (isset($value['integerValue'])) {
                    $product[$key] = (int) $value['integerValue'];
                } elseif (isset($value['doubleValue'])) {
                    $product[$key] = (float) $value['doubleValue'];
                }
            }
        }
        $product['id'] = basename($doc['name']);
        return $product;
    }

    private function addProductToFirestore($productData)
    {
        try {
            $firestoreData = [];
            foreach ($productData as $key => $value) {
                if (is_string($value)) {
                    $firestoreData[$key] = ['stringValue' => $value];
                } elseif (is_int($value)) {
                    $firestoreData[$key] = ['integerValue' => (string) $value];
                } elseif (is_float($value)) {
                    $firestoreData[$key] = ['doubleValue' => $value];
                }
            }

            // Generate a unique document ID
            $documentId = 'product_' . uniqid() . '_' . time();

            $url = "{$this->firestoreUrl}/products/{$documentId}?key={$this->apiKey}";
            $response = Http::patch($url, [
                'fields' => $firestoreData
            ]);

            // Debug: Log the response for troubleshooting
            \Log::info('Firestore Add Product Response:', [
                'url' => $url,
                'status' => $response->status(),
                'body' => $response->body(),
                'data' => $firestoreData
            ]);

            if ($response->successful()) {
                return true;
            } else {
                // Firebase failed, fallback to local database
                $productData['id'] = $documentId; // Add the generated ID
                Product::create($productData);
                return false; // Indicate Firebase failed
            }
        } catch (\Exception $e) {
            // Firebase failed, fallback to local database
            $productData['id'] = 'local_' . uniqid() . '_' . time();
            Product::create($productData);
            return false; // Indicate Firebase failed
        }
    }
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
     * Fetches ALL products from Firebase Firestore.
     */
    public function shop()
    {
        $products = $this->getProductsFromFirestore();

        // If no products in Firebase, show a message
        if (empty($products)) {
            return view('shop', [
                'products' => collect([]),
                'currentPage' => 1,
                'total' => 0,
                'perPage' => 12,
                'message' => 'No products available. Admin needs to add products first.'
            ]);
        }

        // For pagination, since Firestore doesn't have built-in pagination like Eloquent
        // We'll implement simple pagination
        $perPage = 12;
        $page = request('page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedProducts = array_slice($products, $offset, $perPage);

        return view('shop', [
            'products' => collect($paginatedProducts),
            'currentPage' => $page,
            'total' => count($products),
            'perPage' => $perPage
        ]);
    }

    /**
     * Show a single product detail page.
     * @param string $id The product document ID.
     */
    public function productDetail($id)
    {
        try {
            $response = Http::get("{$this->firestoreUrl}/products/{$id}");

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['fields'])) {
                    $product = [];
                    foreach ($data['fields'] as $key => $value) {
                        if (isset($value['stringValue'])) {
                            $product[$key] = $value['stringValue'];
                        } elseif (isset($value['integerValue'])) {
                            $product[$key] = (int) $value['integerValue'];
                        } elseif (isset($value['doubleValue'])) {
                            $product[$key] = (float) $value['doubleValue'];
                        }
                    }
                    $product['id'] = $id;

                    return view('product_detail', [
                        'product' => $product
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Fallback to local database
        }

        // Fallback to local database
        $product = Product::findOrFail($id);
        return view('product_detail', ['product' => $product]);
    }

    /**
     * Add a product to the cart (Firebase-based).
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;
        $userId = Auth::id() ?? 'guest_' . session()->getId();

        // Get current cart from Firebase
        $cart = $this->getCartFromFirebase($userId);

        // Check if product already in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Get product details from Firestore or local database
            $products = $this->getProductsFromFirestore();
            $product = collect($products)->firstWhere('id', $productId);

            if (!$product) {
                // Try local database as fallback
                $localProduct = Product::find($productId);
                if ($localProduct) {
                    $product = $localProduct->toArray();
                }
            }

            if ($product) {
                $cart[$productId] = [
                    'id' => $product['id'],
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'image' => $product['image'] ?? '',
                    'quantity' => $quantity,
                ];
            }
        }

        // Save cart back to Firebase
        $this->saveCartToFirebase($userId, $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function getCartFromFirebase($userId)
    {
        // Cache cart data for 2 minutes to improve performance
        return Cache::remember("cart_data_{$userId}", 120, function () use ($userId) {
            try {
                $url = "{$this->firestoreUrl}/carts/{$userId}?key={$this->apiKey}";
                $response = Http::timeout(5)->get($url); // Add timeout

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['fields']['items']['mapValue']['fields'])) {
                        $cartData = $data['fields']['items']['mapValue']['fields'];
                        $cart = [];
                        foreach ($cartData as $productId => $itemData) {
                            $cart[$productId] = [
                                'id' => $itemData['mapValue']['fields']['id']['stringValue'],
                                'title' => $itemData['mapValue']['fields']['title']['stringValue'],
                                'price' => (float) $itemData['mapValue']['fields']['price']['doubleValue'],
                                'image' => $itemData['mapValue']['fields']['image']['stringValue'] ?? '',
                                'quantity' => (int) $itemData['mapValue']['fields']['quantity']['integerValue'],
                            ];
                        }
                        return $cart;
                    }
                }
            } catch (\Exception $e) {
                // Fallback to session
            }

            // Fallback to session
            return session('cart', []);
        });
    }

    public function saveCartToFirebase($userId, $cart)
    {
        try {
            $firestoreCart = [];
            foreach ($cart as $productId => $item) {
                $firestoreCart[$productId] = [
                    'mapValue' => [
                        'fields' => [
                            'id' => ['stringValue' => $item['id']],
                            'title' => ['stringValue' => $item['title']],
                            'price' => ['doubleValue' => $item['price']],
                            'image' => ['stringValue' => $item['image'] ?? ''],
                            'quantity' => ['integerValue' => $item['quantity']],
                        ]
                    ]
                ];
            }

            $cartData = [
                'fields' => [
                    'userId' => ['stringValue' => $userId],
                    'items' => [
                        'mapValue' => [
                            'fields' => $firestoreCart
                        ]
                    ],
                    'updated_at' => ['timestampValue' => now()->toISOString()],
                ]
            ];

            $url = "{$this->firestoreUrl}/carts/{$userId}?key={$this->apiKey}";
            $response = Http::patch($url, $cartData);

            if ($response->successful()) {
                // Clear cache when cart is updated
                Cache::forget("cart_data_{$userId}");
                Cache::forget("cart_{$userId}");

                // Also save to session as backup
                session(['cart' => $cart]);
                return true;
            }
        } catch (\Exception $e) {
            // Fallback to session only
        }

        // Clear cache even on failure to ensure consistency
        Cache::forget("cart_data_{$userId}");
        Cache::forget("cart_{$userId}");

        // Fallback to session
        session(['cart' => $cart]);
        return false;
    }

    /**
     * Show the checkout page.
     * Uses the 'session' cart (temporary storage until purchase).
     */
    public function checkout()
    {
        // 1. Retrieve the cart from Firebase
        $userId = Auth::id() ?? 'guest_' . session()->getId();
        $cartItems = $this->getCartFromFirebase($userId);

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
            'item_id' => 'required|string',
            'action' => 'required|string|in:increase,decrease,remove',
        ]);

        $itemId = $validated['item_id'];
        $action = $validated['action'];
        $userId = Auth::id() ?? 'guest_' . session()->getId();

        // Get cart from Firebase
        $cart = $this->getCartFromFirebase($userId);

        $updated = false;
        $productName = "Product";

        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                $productName = $item['title'];

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

        // Save updated cart to Firebase
        $this->saveCartToFirebase($userId, $cart);

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

        // 2. Get Cart Data from Firebase
        $userId = Auth::id() ?? 'guest_' . session()->getId();
        $cart = $this->getCartFromFirebase($userId);
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
                // Ensure we have a valid product ID for the order item
                $productId = $item['id'];

                // If the product ID is from Firebase and doesn't exist locally, create a local copy
                $localProduct = Product::find($productId);
                if (!$localProduct) {
                    // Create a local product record for the order
                    $localProduct = Product::create([
                        'title' => $item['title'],
                        'description' => 'Imported from Firebase for order',
                        'price' => $item['price'],
                        'image' => $item['image'] ?? 'https://via.placeholder.com/400x300?text=No+Image',
                        'category' => 'Imported',
                        'quantity' => 999, // Large quantity since it's just for order reference
                    ]);
                    $productId = $localProduct->id;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['title'], // Storing title snapshots is good practice
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                // Optional: Decrease stock from Product table
                // Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }

            DB::commit(); // Save everything

            // 4. Clear the Cart from Firebase
            $this->saveCartToFirebase($userId, []);

            // 5. Redirect to Thank You
            return redirect()->route('thankyou')->with([
                'success' => 'Order placed successfully!',
                'order_id' => $order->id,
                'grand_total' => $totals['grandTotal'], // Store as float, not formatted string
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

        // Search in Firestore
        $products = $this->getProductsFromFirestore();
        $results = [];

        foreach ($products as $product) {
            if (stripos($product['title'] ?? '', $query) !== false ||
                stripos($product['description'] ?? '', $query) !== false) {
                $results[] = $product;
            }
        }

        return view('search_results', [
            'results' => collect($results),
            'query' => $query,
            'hasResults' => !empty($results),
        ]);
    }

    public function adminProducts()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $products = $this->getProductsFromFirestore();

        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|url',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $productData = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image ?: 'https://via.placeholder.com/400x300?text=No+Image',
            'category' => $request->category,
            'price' => (float) $request->price,
            'quantity' => (int) $request->quantity,
            'created_at' => now()->toISOString(),
        ];

        if ($this->addProductToFirestore($productData)) {
            // Clear product cache when new product is added
            Cache::forget('firestore_products');
            return redirect()->route('admin.products')->with('success', 'Product added successfully to Firebase!');
        } else {
            return redirect()->route('admin.products')->with('warning', 'Product saved locally. Firebase connection failed - check your Firestore database setup.');
        }
    }

    public function deleteProduct($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        try {
            // Try to delete from Firestore first
            $response = Http::delete("{$this->firestoreUrl}/products/{$id}?key={$this->apiKey}");

            if ($response->successful()) {
                // Clear product cache when product is deleted
                Cache::forget('firestore_products');
                return redirect()->route('admin.products')->with('success', 'Product deleted successfully from Firestore!');
            }
        } catch (\Exception $e) {
            // If Firestore fails, continue to local database
        }

        // Fallback to local database
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            // Clear product cache when product is deleted
            Cache::forget('firestore_products');
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully from local database!');
        }

        return redirect()->route('admin.products')->with('error', 'Product not found.');
    }
}