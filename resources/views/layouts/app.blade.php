<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pet Paradise')</title>
    <!-- Load Tailwind CSS CDN for quick setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fce9f1 0%, #f6faff 100%);
            min-height: 100vh;
        }
        .rating-star {
            color: #ffc107; /* Gold color for stars */
        }
    </style>
</head>
<body class="text-gray-800">

    <div id="app-container" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- COMMON HEADER (NAVBAR) - Consistent across all pages -->
        <header class="py-4 flex justify-between items-center sticky top-0 bg-white/80 backdrop-blur-md z-10 rounded-b-xl shadow-sm px-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl font-bold text-orange-600">
                <h1>🐾</h1>

                <span>Pet Paradise</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-orange-600 transition duration-150 py-2 @if(Route::is('home')) font-semibold text-orange-600 border-b-2 border-orange-600 @endif">Home</a>
                <a href="{{ route('shop') }}" class="hover:text-orange-600 transition duration-150 py-2 @if(Route::is('shop')) font-semibold text-orange-600 border-b-2 border-orange-600 @endif">Shop</a>
                <a href="#" class="hover:text-orange-600 transition duration-150 py-2">Services</a>
                <a href="#" class="hover:text-orange-600 transition duration-150 py-2">About</a>
                <a href="#" class="hover:text-orange-600 transition duration-150 py-2">Contact</a>
            </nav>

            <!-- Icons -->
                <form action="{{ route('search') }}" method="GET" class="flex items-stretch">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search products..."
                        required
                        class="border border-r-0 border-gray-300 rounded-l-md px-4 py-2 
                            focus:outline-none focus:ring-2 focus:ring-brand-orange 
                            transition duration-150"
                    >
                    
                    <button type="submit" 
                            class="bg-brand-orange text-white 
                                px-4 py-2 
                                rounded-r-md 
                                hover:bg-orange-700 
                                transition duration-150 
                                flex items-center justify-center">
                        
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </button>
                </form>
                @php
                    // Fetch the cart data from the session
                    $cart = Session::get('cart', []);
                    // Calculate the total number of items (not unique products)
                    $cartCount = array_sum(array_column($cart, 'quantity'));
                @endphp

                <a href="{{ route('checkout') }}" aria-label="Cart" 
                    class="p-2 rounded-full hover:bg-gray-100 transition duration-150 relative">

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        
                        @if ($cartCount > 0)
                            <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center h-4 w-4 rounded-full ring-2 ring-white bg-orange-500 text-white text-xs leading-none p-0.5 transform translate-x-1/4 -translate-y-1/4">
                                {{ $cartCount }}
                            </span>
                        @endif
                </a>
                <button aria-label="Menu" class="md:hidden p-2 rounded-full hover:bg-gray-100 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
            </div>
        </header>

        <!-- MAIN CONTENT AREA - Where specific views are injected -->
        <main id="content-area" class="py-8 min-h-[70vh]">
            @yield('content')
        </main>

        <!-- Script to initialize Lucide icons -->
        <script>
            window.onload = () => {
                lucide.createIcons();
            };
        </script>
    </div>
</body>
</html>