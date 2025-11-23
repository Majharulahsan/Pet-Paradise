@extends('layouts.app')

@section('title', 'Shop - Pet Products')

@section('content')
    <!-- SHOP/PRODUCT LISTING VIEW -->
    <section id="shop-view" class="pt-4 pb-24">
        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-orange-600 transition duration-150 flex items-center mb-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Home
        </a>

        <!-- Shop Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Premium Pet Products</h2>
            <p class="text-gray-600">Discover our handpicked selection of high-quality products for your beloved pets.</p>
        </div>

        <!-- Filters/Sort (Static for this demo) -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 bg-white p-4 rounded-xl shadow-md border border-gray-100">
            <!-- Featured Dropdown -->
            <div class="relative inline-block text-left w-full sm:w-auto mr-0 sm:mr-4 mb-4 sm:mb-0">
                <select id="sort-by" class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-orange-500 cursor-pointer shadow-inner">
                    <option value="featured">Featured</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Average Rating</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 sm:right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            <!-- All Categories Dropdown -->
            <div class="relative inline-block text-left w-full sm:w-auto">
                <select id="category-filter" class="appearance-none block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-orange-500 cursor-pointer shadow-inner">
                    <option value="all">All Categories</option>
                    <option value="food">Food & Nutrition</option>
                    <option value="toys">Toys & Play</option>
                    <option value="care">Comfort & Care</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 sm:right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <!-- Product Grid - Dynamic using Blade -->
        <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            {{-- Loop through the products array passed from the controller --}}
            @foreach ($products as $product)
            <!-- Product Card -->
            <a href="{{ route('product.detail', ['id' => $product['id']]) }}" class="product-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 cursor-pointer">
                <div class="relative h-64">
                    <img src="{{ $product['image'] }}" onerror="this.onerror=null;this.src='https://placehold.co/400x300/e9d5ff/6b46c1?text=Placeholder';" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">In Stock</span>
                </div>
                <div class="p-5">
                    <p class="text-xs text-orange-500 font-semibold mb-1">{{ $product['category'] }}</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">{{ $product['name'] }}</h3>
                    <div class="flex items-center mb-4">
                        <!-- Star Rating - Dynamic based on $product['rating'] -->
                        <div class="flex text-sm rating-star mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                {{-- Use HTML entity for better star display compatibility --}}
                                <span class="text-base {{ $i <= $product['rating'] ? 'rating-star' : 'text-gray-300' }}">&#9733;</span>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-500">({{ $product['reviews'] }})</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-orange-600">৳{{ number_format($product['price']) }}</span>
                        <button onclick="event.preventDefault(); /* Add to cart logic */" class="add-to-cart-btn flex items-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-xl hover:bg-orange-700 transition duration-150 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Add
                        </button>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
@endsection