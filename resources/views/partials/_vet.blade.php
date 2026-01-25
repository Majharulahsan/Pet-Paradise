<!-- 3. VET SERVICES (Initially Hidden) -->
        <div id="vet-content" class="tab-content">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Specialized Veterinary Procedures</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1: Emergency Care --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Emergency Care</h3>
                    <p class="text-gray-600 mb-4">Immediate care for urgent health issues.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳18,000</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'emergency-care']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 2: Dental Cleaning (Most Popular) --}}
                <div class="bg-white p-6 rounded-2xl shadow-2xl border-4 border-[#f97316] relative transform scale-105">
                    <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full">Most Popular</span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Dental Cleaning</h3>
                    <p class="text-gray-600 mb-4">Professional dental care under anesthesia.</p>
                    <p class="text-3xl font-bold text-[#f97316] mb-6">৳24,000</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'dental-cleaning']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 3: Surgery Consultation --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Surgery Consultation</h3>
                    <p class="text-gray-600 mb-4">Expert consultation for surgical procedures.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳9,000</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'surgery-consultation']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
            </div>
        </div>