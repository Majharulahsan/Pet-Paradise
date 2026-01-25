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
        <div class="flex flex-col sm:flex-row justify-between items-center mb-12">
            <div class="text-center sm:text-left">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-2">Premium Pet Products</h2>
                <p class="text-gray-600">Discover our handpicked selection of high-quality products for your beloved pets.</p>
            </div>
            @auth
                @if(Auth::user()->role === 'admin')
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition duration-150 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Product
                    </a>
                </div>
                @endif
            @endauth
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
            {{-- Check if products exist --}}
            @if($products->isEmpty())
                <div class="col-span-full text-center py-12">
                    <div class="bg-gray-100 rounded-xl p-8 max-w-md mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 text-gray-400"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Available</h3>
                        <p class="text-gray-600">{{ $message ?? 'Products will be added by the admin soon.' }}</p>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 transition duration-150">
                                    Add First Product
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            @else
                {{-- Loop through the products array passed from the controller --}}
                @foreach ($products as $product)
            <!-- Product Card -->
            @auth
                @if(Auth::user()->role === 'admin')
                <div class="product-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300">
                @else
                <a href="{{ route('product.detail', ['id' => $product['id']]) }}" class="product-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 cursor-pointer block">
                @endif
            @else
                <a href="{{ route('product.detail', ['id' => $product['id']]) }}" class="product-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition duration-300 cursor-pointer block">
            @endauth
                <div class="relative h-64">
                    <img src="{{ $product['image'] }}" onerror="this.onerror=null;this.src='https://placehold.co/400x300/e9d5ff/6b46c1?text=Placeholder';" alt="{{ $product['title'] }}" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">In Stock</span>
                    @auth
                        @if(Auth::user()->role === 'admin')
                        <form action="{{ route('admin.products.delete', $product['id']) }}" method="POST" class="absolute top-3 left-3" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition duration-150 shadow-lg" title="Delete Product">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="m19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
                <div class="p-5">
                    <p class="text-xs text-orange-500 font-semibold mb-1">{{ $product['category'] }}</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">{{ $product['title'] }}</h3>
                    <div class="flex items-center mb-4">
                        <!-- Star Rating - Dynamic based on $product['rating'] -->
                        <div class="flex text-sm rating-star mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                {{-- Use HTML entity for better star display compatibility --}}
                                <span class="text-base {{ $i <= ($product['rating'] ?? 4) ? 'rating-star' : 'text-gray-300' }}">&#9733;</span>
                            @endfor
                        </div>
                        <span class="text-xs text-gray-500">({{ $product['reviews'] ?? 0 }})</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-orange-600">৳{{ number_format($product['price']) }}</span>
                        <form action="{{ route('cart.add') }}" method="POST" class="inline">
                            @csrf
                            {{-- Hidden fields for product ID and quantity (default to 1) --}}
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" class="add-to-cart-btn flex items-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-xl hover:bg-orange-700 transition duration-150 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            @auth
                @if(Auth::user()->role === 'admin')
                </div>
                @else
                </a>
                @endif
            @else
                </a>
            @endauth
            @endforeach
            @endif
        </div>
    </section>
@endsection