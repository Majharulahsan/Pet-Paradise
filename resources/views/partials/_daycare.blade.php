<!-- 4. DAYCARE SERVICES (Initially Hidden) -->
        <div id="daycare-content" class="tab-content">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Fun & Safe Daycare Options</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1: Half Day Care --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Half Day Care</h3>
                    <p class="text-gray-600 mb-4">Perfect for busy mornings or afternoons.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳3,600</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'half-day-care']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 2: Full Day Care (Most Popular) --}}
                <div class="bg-white p-6 rounded-2xl shadow-2xl border-4 border-[#f97316] relative transform scale-105">
                    <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full">Most Popular</span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Full Day Care</h3>
                    <p class="text-gray-600 mb-4">Complete day of fun and care for your pet.</p>
                    <p class="text-3xl font-bold text-[#f97316] mb-6">৳6,000</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'full-day-care']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 3: Weekly Pass --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Weekly Pass</h3>
                    <p class="text-gray-600 mb-4">Best value for regular daycare needs (5 full days).</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳25,000</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'weekly-pass']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
            </div>
        </div>

    </div>