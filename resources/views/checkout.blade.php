@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <section id="checkout-view" class="pt-4 pb-24"
        x-data="{ 
            grandTotal: {{ $grandTotal }},
            shippingName: '',
            shippingEmail: '',
            shippingPhone: '',
            shippingAddress: '',
            paymentMethod: 'cod', // Default to Cash on Delivery
            
            // Computed property for form validation
            get isFormValid() {
                // Check if all required fields have content and the cart is not empty
                return this.shippingName.trim() !== '' &&
                       this.shippingEmail.trim() !== '' &&
                       this.shippingPhone.trim() !== '' &&
                       this.shippingAddress.trim() !== '' &&
                       !{{ $isCartEmpty ? 'true' : 'false' }};
            }
        }">
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">Please correct the following errors:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($isCartEmpty)
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-8 text-center" role="alert">
                <strong class="font-bold">Your cart is empty!</strong>
                <span class="block sm:inline"> Please add products to your cart before proceeding to checkout.</span>
                <a href="{{ route('shop') }}" class="text-yellow-800 underline hover:text-yellow-900 font-medium ml-2">Go to Shop</a>
            </div>
        @endif

        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <div class="lg:col-span-7 space-y-8">
                    
                    <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
                        <h2 class="text-xl font-bold mb-6 text-gray-800">1. Customer Information</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="shipping_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input type="text" id="shipping_name" name="shipping_name" 
                                       x-model="shippingName" 
                                       placeholder="Enter your full name" 
                                       required
                                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3 border @error('shipping_name') border-red-500 @enderror">
                                @error('shipping_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="shipping_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                    <input type="email" id="shipping_email" name="shipping_email" 
                                           x-model="shippingEmail" 
                                           placeholder="you@example.com" 
                                           required
                                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3 border @error('shipping_email') border-red-500 @enderror">
                                    @error('shipping_email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                    <input type="tel" id="shipping_phone" name="shipping_phone" 
                                           x-model="shippingPhone" 
                                           placeholder="e.g., +8801XXXXXXXXX" 
                                           required
                                           class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3 border @error('shipping_phone') border-red-500 @enderror">
                                    @error('shipping_phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address *</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3" 
                                          x-model="shippingAddress" 
                                          placeholder="Street address, City, Postal Code" 
                                          required
                                          class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3 border @error('shipping_address') border-red-500 @enderror"></textarea>
                                @error('shipping_address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
                        <h2 class="text-xl font-bold mb-6 text-gray-800">2. Payment Method</h2>
                        
                        <div class="space-y-4">
                            <label for="payment-cod" class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition duration-150">
                                <input type="radio" id="payment-cod" name="payment_method" value="cod" x-model="paymentMethod" required class="form-radio text-orange-600 focus:ring-orange-500 h-4 w-4">
                                <span class="ml-3 text-base font-medium text-gray-900">Cash on Delivery (COD)</span>
                            </label>

                            <label for="payment-bkash" class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition duration-150">
                                <input type="radio" id="payment-bkash" name="payment_method" value="bkash" x-model="paymentMethod" required class="form-radio text-orange-600 focus:ring-orange-500 h-4 w-4">
                                <span class="ml-3 text-base font-medium text-gray-900">bKash Mobile Banking</span>
                                <span class="ml-auto text-sm text-pink-600 font-medium">৳{{ number_format($grandTotal) }}</span>
                            </label>
                            
                            <label for="payment-nagad" class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition duration-150">
                                <input type="radio" id="payment-nagad" name="payment_method" value="nagad" x-model="paymentMethod" required class="form-radio text-orange-600 focus:ring-orange-500 h-4 w-4">
                                <span class="ml-3 text-base font-medium text-gray-900">Nagad Mobile Banking</span>
                                <span class="ml-auto text-sm text-red-600 font-medium">৳{{ number_format($grandTotal) }}</span>
                            </label>

                            <label for="payment-rocket" class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 transition duration-150">
                                <input type="radio" id="payment-rocket" name="payment_method" value="rocket" x-model="paymentMethod" required class="form-radio text-orange-600 focus:ring-orange-500 h-4 w-4">
                                <span class="ml-3 text-base font-medium text-gray-900">Rocket Mobile Banking</span>
                                <span class="ml-auto text-sm text-purple-600 font-medium">৳{{ number_format($grandTotal) }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white p-6 rounded-3xl shadow-lg border border-orange-100 sticky top-24">
                        <h2 class="text-xl font-bold mb-4">Order Summary</h2>

                        <div class="space-y-4 mb-6 max-h-72 overflow-y-auto pr-2 custom-scrollbar">
                            @if (!empty($cartItems))
                                @foreach ($cartItems as $item)
                                    <?php 
                                        $lineTotal = $item['price'] * $item['quantity'];
                                    ?>
                                    <div class="py-2 border-b border-gray-100 last:border-0">
                                        
                                        <div class="flex items-start gap-4 mb-2">
                                            <div class="w-16 h-16 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                                                <img src="{{ !empty($item['image']) ? $item['image'] : 'assets/default-product.png' }}"
                                                     alt="{{ htmlspecialchars($item['name']) }}"
                                                     class="w-full h-full object-cover">
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-sm truncate" title="{{ $item['name'] }}">{{ $item['name'] }}</h4>
                                                <p class="text-xs text-gray-500">Unit Price: ৳{{ number_format($item['price']) }}</p>
                                                <span class="font-bold text-gray-900 text-sm">৳{{ number_format($lineTotal) }}</span>
                                            </div>

                                            <form action="{{ route('cart.update') }}" method="POST" class="shrink-0 mt-1">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                <input type="hidden" name="action" value="remove">
                                                <button type="submit" 
                                                        class="text-red-500 hover:text-red-700 transition duration-150" 
                                                        title="Remove Item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <div class="flex items-center justify-end text-right">
                                            <span class="text-xs text-gray-500 mr-2">Quantity:</span>
                                            <div class="inline-flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                                
                                                <form action="{{ route('cart.update') }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                    <input type="hidden" name="action" value="decrease">
                                                    <button type="submit" 
                                                            class="w-8 h-8 flex justify-center items-center text-gray-600 hover:bg-gray-100 transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    </button>
                                                </form>

                                                <span class="w-8 h-8 flex justify-center items-center text-sm font-medium border-x border-gray-300">{{ $item['quantity'] }}</span>
                                                
                                                <form action="{{ route('cart.update') }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                                    <input type="hidden" name="action" value="increase">
                                                    <button type="submit" 
                                                            class="w-8 h-8 flex justify-center items-center text-gray-600 hover:bg-gray-100 transition duration-150">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <p class="text-center text-gray-500 py-4">Your cart is empty.</p>
                            @endif
                        </div>

                        <div class="space-y-3 pb-6 border-b border-gray-200">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-medium">৳{{ number_format($subtotal) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="font-medium">৳{{ number_format($shipping) }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between text-brand-orange font-bold text-xl pt-2 mt-2">
                            <span>Total</span>
                            <span x-init="grandTotal = {{ $grandTotal }}">৳{{ number_format($grandTotal) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                            :disabled="!isFormValid"
                            :class="!isFormValid ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-lg hover:-translate-y-0.5'"
                            class="w-full bg-orange-600 hover:bg-orange-700 text-white py-4 rounded-xl font-bold text-lg shadow-md transition-all duration-300 flex justify-center items-center gap-2">
                        <span>Place Order</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-4 flex justify-center items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Your details are secured.
                    </p>
                </div>
            </div>
        </form>
        <form method="POST" action="{{ route('order.place') }}">
            
            @csrf 
            
            <div class="lg:col-span-7">
                </div>

            <div class="lg:col-span-5">
                <button type="submit"
                        :disabled="!isFormValid"
                        class="w-full bg-brand-orange text-white py-4 rounded-xl font-bold text-lg shadow-md transition-all duration-300 flex justify-center items-center gap-2">
                    <span>Place Order</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                </div>

        </form>
        </section>
@endsection