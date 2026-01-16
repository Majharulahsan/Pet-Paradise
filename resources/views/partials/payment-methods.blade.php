<div id="payment-method-section" class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
    <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-800">
        <i class="fa-solid fa-credit-card text-brand-orange"></i>
        Select Payment Method
    </h2>

    <div class="space-y-4">
        {{-- Radio Group for Payment Methods --}}
        <div class="space-y-3">
            {{-- Helper function for payment radio button --}}
            @php
                function radioOption($id, $label, $iconClass, $imageSrc = null) {
                    echo "
                    <label for=\"$id\" class=\"flex items-center p-4 border rounded-xl cursor-pointer transition duration-150\" 
                           :class=\"selectedPayment === '$id' ? 'border-orange-500 ring-2 ring-orange-200 bg-orange-50/50' : 'border-gray-200 hover:border-orange-300'\">
                        <input type=\"radio\" id=\"$id\" name=\"payment_method\" x-model=\"selectedPayment\" value=\"$id\" class=\"hidden\">
                        <span class=\"flex items-center gap-4\">
                            " . ($imageSrc ? "<img src=\"$imageSrc\" alt=\"$label\" class=\"w-8 h-8 object-contain\">" : "<i class=\"$iconClass text-2xl w-8 text-orange-600\"></i>") . "
                            <span class=\"font-medium text-gray-800\">$label</span>
                        </span>
                    </label>
                    ";
                }
            @endphp
            
            {{-- 1. Cash on Delivery (COD) --}}
            @php radioOption('cod', 'Cash on Delivery (COD)', 'fa-solid fa-hand-holding-dollar'); @endphp

            {{-- 2. Mobile Payments --}}
            @php radioOption('bkash', 'Bkash', '', 'https://upload.wikimedia.org/wikipedia/commons/4/46/Bkash_logo.png'); @endphp
            @php radioOption('nagad', 'Nagad', '', 'https://upload.wikimedia.org/wikipedia/commons/e/ef/Nagad_Logo.png'); @endphp
            @php radioOption('rocket', 'Rocket', '', 'https://i.ibb.co/6y45pYx/rocket-logo.png'); @endphp {{-- Placeholder/example image for Rocket --}}

            {{-- 3. Credit/Debit Card --}}
            @php radioOption('card', 'Credit/Debit Card', 'fa-brands fa-cc-visa'); @endphp
        </div>

        {{-- Conditional Payment Details --}}
        <div id="payment-details" class="pt-4 border-t border-gray-100 space-y-4">
            
            {{-- Mobile Payment Fields (Bkash, Nagad, Rocket) --}}
            <template x-if="['bkash', 'nagad', 'rocket'].includes(selectedPayment)">
                <div class="space-y-4 p-4 bg-orange-50 rounded-xl border border-orange-200">
                    <p class="text-sm text-gray-600">
                        Please complete the payment to the **Merchant Number: 01XXX-XXXXXX** first.
                        After payment, enter your details below.
                    </p>
                    <div>
                        <label for="mobilePaymentNumber" class="block text-sm font-medium text-gray-700">Your Mobile Number <span class="text-red-500">*</span></label>
                        <input type="tel" id="mobilePaymentNumber" x-model="phone" required
                               class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>
                    <div>
                        <label for="mobilePaymentTxnId" class="block text-sm font-medium text-gray-700">Transaction ID (TxnID) <span class="text-red-500">*</span></label>
                        <input type="text" id="mobilePaymentTxnId" required
                               class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>
                </div>
            </template>

            {{-- Credit/Debit Card Fields --}}
            <template x-if="selectedPayment === 'card'">
                <div class="space-y-4 p-4 bg-orange-50 rounded-xl border border-orange-200">
                    <p class="text-sm text-gray-600">
                        Payment processing is secured by our partner. Your card information is not stored.
                    </p>
                    <div>
                        <label for="cardholderName" class="block text-sm font-medium text-gray-700">Cardholder Name <span class="text-red-500">*</span></label>
                        <input type="text" id="cardholderName" x-model="cardholderName" required
                               class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>
                    <div>
                        <label for="cardNumber" class="block text-sm font-medium text-gray-700">Card Number <span class="text-red-500">*</span></label>
                        <input type="text" id="cardNumber" x-model="cardNumber" required placeholder="XXXX XXXX XXXX XXXX"
                               class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="cardExpiry" class="block text-sm font-medium text-gray-700">Expiry Date <span class="text-red-500">*</span></label>
                            <input type="text" id="cardExpiry" x-model="cardExpiry" required placeholder="MM/YY"
                                   class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="cardCVV" class="block text-sm font-medium text-gray-700">CVV <span class="text-red-500">*</span></label>
                            <input type="text" id="cardCVV" x-model="cardCVV" required placeholder="***"
                                   class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>