<div id="order-summary-section" class="lg:col-span-5">
    <div class="bg-white p-6 rounded-3xl shadow-lg border border-orange-100 sticky lg:top-24">
        
        {{-- Mobile Collapse Header --}}
        <div class="flex justify-between items-center lg:hidden cursor-pointer" @click="isSummaryOpen = !isSummaryOpen">
            <h2 class="text-xl font-bold mb-0">Order Summary</h2>
            <span class="text-orange-500 text-lg" x-text="isSummaryOpen ? 'Hide' : 'Show'"></span>
        </div>

        {{-- Desktop Header --}}
        <h2 class="text-xl font-bold mb-4 hidden lg:block">Order Summary</h2>

        {{-- Cart Items List (Collapsible on Mobile) --}}
        <div x-show="isSummaryOpen" class="mt-4 lg:mt-0">
            <div class="space-y-2 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                
                @if ($isCartEmpty)
                    <p class="text-gray-500 text-center py-4 border border-dashed border-gray-200 rounded-xl">Your cart is empty.</p>
                @else
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between text-sm text-gray-700 py-1 border-b border-gray-50 last:border-0">
                            {{-- Product Name & Quantity --}}
                            <span class="text-gray-600">
                                {{ $item['name'] }} <span class="font-bold text-orange-500">× {{ $item['quantity'] }}</span>
                            </span>
                            {{-- Line Total --}}
                            <span class="font-medium text-gray-800">
                                ৳{{ number_format($item['price'] * $item['quantity']) }}
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Totals Section --}}
            <div class="space-y-2 mb-6">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span class="font-medium">৳{{ number_format($subtotal) }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Shipping</span>
                    <span class="font-medium">৳{{ number_format($shipping) }}</span>
                </div>
                <div class="flex justify-between text-brand-orange font-bold text-xl pt-2 border-t border-gray-200 mt-2">
                    <span>Final Total</span>
                    <span class="text-2xl">৳{{ number_format($grandTotal) }}</span>
                </div>
            </div>
            
            {{-- Action Button --}}
            <button type="button"
                    @click="isFormValid ? alert('Order Placed! Thank you for your purchase.') : alert('Please fill in all required fields.')"
                    :disabled="!isFormValid"
                    :class="!isFormValid ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-lg hover:-translate-y-0.5'"
                    class="w-full bg-brand-orange text-white py-4 rounded-xl font-bold text-lg shadow-md transition-all duration-300 flex justify-center items-center gap-2">
                <span>Confirm Payment & Place Order</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
            
            <template x-if="!isCustomerFormValid()">
                <p class="text-center text-xs text-red-500 mt-2">Please complete the Customer Information form.</p>
            </template>
            <template x-if="!isPaymentFormValid() && isCustomerFormValid()">
                <p class="text-center text-xs text-red-500 mt-2">Please complete the Payment details for your chosen method.</p>
            </template>
            <template x-if="isCartEmpty">
                <p class="text-center text-xs text-red-500 mt-2">Cannot place order with an empty cart.</p>
            </template>

        </div>

    </div>
</div>