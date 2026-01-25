<div id="customer-info-section" class="bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
    <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-800">
        <i class="fa-solid fa-user-circle text-brand-orange"></i>
        Customer & Delivery Information
    </h2>
    <form class="space-y-4">
        {{-- Full Name --}}
        <div>
            <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
            <input type="text" id="fullName" x-model="fullName" required
                   class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        {{-- Address Line 1 --}}
        <div>
            <label for="address1" class="block text-sm font-medium text-gray-700">Address Line 1 <span class="text-red-500">*</span></label>
            <input type="text" id="address1" x-model="address1" required
                   class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        {{-- Address Line 2 (Optional) --}}
        <div>
            <label for="address2" class="block text-sm font-medium text-gray-700">Address Line 2 (Optional)</label>
            <input type="text" id="address2"
                   class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {{-- City --}}
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City <span class="text-red-500">*</span></label>
                <input type="text" id="city" x-model="city" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            {{-- Postal Code --}}
            <div>
                <label for="postalCode" class="block text-sm font-medium text-gray-700">Postal Code <span class="text-red-500">*</span></label>
                <input type="text" id="postalCode" x-model="postalCode" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            {{-- Phone Number --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                <input type="tel" id="phone" x-model="phone" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>

            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                <input type="email" id="email" x-model="email" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            </div>
        </div>
    </form>
</div>