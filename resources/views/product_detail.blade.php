@extends('layouts.app')

@section('title', $product['name'] . ' - Pet Paradise')

@section('content')
    <!-- PRODUCT DETAIL VIEW -->
    <section id="product-detail-view" class="pt-4 pb-24">
        <a href="{{ route('shop') }}" class="text-sm text-gray-500 hover:text-orange-600 transition duration-150 flex items-center mb-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Shop
        </a>

        <div class="flex flex-col lg:flex-row gap-12 bg-white p-8 rounded-3xl shadow-2xl border border-gray-100">
            <!-- Left: Image Gallery -->
            <div class="lg:w-1/2 flex flex-col items-center">
                <!-- Main Image -->
                <div class="w-full aspect-square overflow-hidden rounded-2xl mb-4 shadow-xl ring-1 ring-gray-100">
                    <img id="detail-main-image" src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                </div>
                <!-- Thumbnails (Mocked) -->
                <div class="flex space-x-3">
                    <div class="w-16 h-16 rounded-lg overflow-hidden border-2 border-orange-500 cursor-pointer">
                        <img src="{{ $product['image'] }}" alt="Thumbnail 1" class="w-full h-full object-cover">
                    </div>
                    <div class="w-16 h-16 rounded-lg overflow-hidden border-2 border-transparent hover:border-orange-500 transition cursor-pointer">
                        <img src="https://placehold.co/100x100/fecaca/ef4444?text=Alt+View" alt="Thumbnail 2" class="w-full h-full object-cover">
                    </div>
                    <div class="w-16 h-16 rounded-lg overflow-hidden border-2 border-transparent hover:border-orange-500 transition cursor-pointer">
                        <img src="https://placehold.co/100x100/d1d5db/4b5563?text=Packaging" alt="Thumbnail 3" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Right: Product Details -->
            <div class="lg:w-1/2 space-y-6">
                <p class="text-sm font-semibold text-orange-500">{{ $product['category'] }}</p>
                <h1 id="detail-title" class="text-4xl font-extrabold text-gray-900">{{ $product['name'] }}</h1>

                <!-- Rating and Reviews -->
                <div class="flex items-center space-x-4">
                    <div class="flex text-lg rating-star">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-lg {{ $i <= $product['rating'] ? 'rating-star' : 'text-gray-300' }}">&#9733;</span>
                        @endfor
                    </div>
                    <span class="text-gray-500 text-sm">{{ number_format($product['rating'], 1) }} ({{ $product['reviews'] }} reviews)</span>
                </div>

                <!-- Price and Stock -->
                <div class="flex items-center space-x-3 text-2xl font-bold">
                    <span id="detail-price-display" class="text-orange-600">৳{{ number_format($product['price']) }}</span>
                    <span class="text-sm font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full shadow-inner">In Stock ({{ $product['stock'] }} available)</span>
                </div>

                <!-- Description -->
                <p class="text-gray-600 leading-relaxed pt-2">
                    {{ $product['description'] }}
                </p>

                <!-- Quantity Selector and Total -->
                <div class="space-y-4 pt-4">
                    <label for="quantity-input" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <div class="flex items-center space-x-4">
                        <!-- Quantity Controls -->
                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden shadow-sm">
                            <button id="qty-minus" class="p-3 text-gray-600 hover:bg-gray-50 transition duration-150 active:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </button>
                            {{-- Important: Use the actual product price and stock for JS logic --}}
                            <input type="number" id="quantity-input" data-price="{{ $product['price'] }}" value="1" min="1" max="{{ $product['stock'] }}" class="w-12 text-center border-l border-r border-gray-300 p-2 text-base font-medium focus:outline-none" readonly>
                            <button id="qty-plus" class="p-3 text-gray-600 hover:bg-gray-50 transition duration-150 active:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </button>
                        </div>
                        <!-- Total Price -->
                        <span class="text-xl font-medium text-gray-700">Total: <span id="total-price" class="text-orange-600 font-bold">₹{{ number_format($product['price']) }}</span></span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 pt-4">
                    <form action="{{ route('cart.add') }}" method="POST" class="mt-8">
    @csrf

    {{-- Hidden product ID --}}
    <input type="hidden" name="product_id" value="{{ $product['id'] }}">

    <div class="flex items-center space-x-4 mb-8">
        <label for="qty" class="text-gray-700 font-semibold shrink-0">Quantity:</label>

        <div id="qty-control" class="flex items-center border border-gray-300 rounded-lg overflow-hidden shrink-0">
            <button type="button" id="qty-minus" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition duration-150 text-xl font-bold">-</button>
            <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product['stock'] }}" readonly class="w-16 text-center border-none focus:ring-0 focus:border-transparent p-2">
            <button type="button" id="qty-plus" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition duration-150 text-xl font-bold">+</button>
        </div>

        <span class="text-sm text-gray-500">({{ $product['stock'] }} in stock)</span>
    </div>

    <form action="{{ route('cart.add') }}" method="POST" class="mt-8">
        @csrf

        {{-- Hidden product ID --}}
        <input type="hidden" name="product_id" value="{{ $product['id'] }}">

        <div class="flex items-center space-x-4 mb-8">
            <label for="qty" class="text-gray-700 font-semibold shrink-0">Quantity:</label>

            <div id="qty-control" class="flex items-center border border-gray-300 rounded-lg overflow-hidden shrink-0">
                <button type="button" id="qty-minus" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition duration-150 text-xl font-bold">-</button>
                <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product['stock'] }}" readonly class="w-16 text-center border-none focus:ring-0 focus:border-transparent p-2">
                <button type="button" id="qty-plus" class="px-4 py-2 bg-gray-50 hover:bg-gray-100 transition duration-150 text-xl font-bold">+</button>
            </div>

            <span class="text-sm text-gray-500">({{ $product['stock'] }} in stock)</span>
        </div>

        <button type="submit" 
                id="add-to-cart-btn" 
                class="w-full lg:w-3/4 bg-brand-orange text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            Add to Cart
        </button>
    </form>
</form>
                    <button class="p-3 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-50 transition duration-150 active:bg-gray-100" aria-label="Wishlist">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                    </button>
                    <button class="p-3 border border-gray-300 rounded-xl text-gray-600 hover:bg-gray-50 transition duration-150 active:bg-gray-100" aria-label="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
                    </button>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-3 gap-4 pt-6">
                    <div class="feature-card flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl text-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500 mb-1"><path d="M7.86 2h8.28L22 7.86v8.28L16.14 22H7.86L2 16.14V7.86L7.86 2z"></path><path d="M15 9l-6 6"></path><path d="M9 9l6 6"></path></svg>
                        <span class="text-xs font-semibold text-gray-700">Free Shipping</span>
                    </div>
                    <div class="feature-card flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl text-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500 mb-1"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        <span class="text-xs font-semibold text-gray-700">Quality Guarantee</span>
                    </div>
                    <div class="feature-card flex flex-col items-center justify-center p-4 bg-gray-50 rounded-xl text-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500 mb-1"><polyline points="4 7 4 17 14 17"></polyline><polyline points="8 10 8 20 18 20"></polyline><line x1="8" y1="17" x2="18" y2="10"></line></svg>
                        <span class="text-xs font-semibold text-gray-700">30-Day Returns</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Quantity and Total Price JavaScript Logic
            document.addEventListener('DOMContentLoaded', function() {
                const qtyInput = document.getElementById('quantity-input');
                const pricePerUnit = parseInt(qtyInput.dataset.price);
                const totalPriceEl = document.getElementById('total-price');
                const qtyMinus = document.getElementById('qty-minus');
                const qtyPlus = document.getElementById('qty-plus');
                const maxStock = parseInt(qtyInput.getAttribute('max'));

                // Function to format the price (optional, but good practice for currency)
                function formatPrice(amount) {
            
                    return '৳' + amount.toLocaleString('en-IN');
                }

                function updateTotalPrice() {
                    // Ensure the value is a number and minimum is 1
                    let currentQty = Math.max(1, parseInt(qtyInput.value) || 1);
                    // Ensure the value does not exceed max stock
                    currentQty = Math.min(currentQty, maxStock);

                    qtyInput.value = currentQty;

                    const total = currentQty * pricePerUnit;
                    totalPriceEl.textContent = formatPrice(total);
                }

                qtyMinus.addEventListener('click', () => {
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty > 1) {
                        qtyInput.value = currentQty - 1;
                        updateTotalPrice();
                    }
                });

                qtyPlus.addEventListener('click', () => {
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty < maxStock) {
                        qtyInput.value = currentQty + 1;
                        updateTotalPrice();
                    }
                });

                // Initial calculation
                updateTotalPrice();
            });
        </script>
@endsection