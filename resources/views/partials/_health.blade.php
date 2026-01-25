<div id="health-content" class="tab-content">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Comprehensive Wellness Programs</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Card 1: Wellness Exam (Most Popular) --}}
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200 relative">
            <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full">Most Popular</span>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Wellness Exam</h3>
            <p class="text-gray-600 mb-4">Comprehensive health checkup for your pet.</p>
            <p class="text-3xl font-bold text-gray-900 mb-6">৳6,600</p>
            <a href="{{ route('appointment.index', ['service' => 'wellness-exam']) }}" 
               class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700 transition">
               Book Now
            </a>
        </div>

        {{-- Card 2: Vaccination Package --}}
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Vaccination Package</h3>
            <p class="text-gray-600 mb-4">Keep your pet protected with essential vaccinations.</p>
            <p class="text-3xl font-bold text-gray-900 mb-6">৳4,200</p>
            <a href="{{ route('appointment.index', ['service' => 'vaccination-package']) }}" 
               class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700 transition">
               Book Now
            </a>
        </div>

        {{-- Card 3: Senior Pet Care --}}
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Senior Pet Care</h3>
            <p class="text-gray-600 mb-4">Specialized care for aging pets.</p>
            <p class="text-3xl font-bold text-gray-900 mb-6">৳10,200</p>
            <a href="{{ route('appointment.index', ['service' => 'senior-pet-care']) }}" 
               class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700 transition">
               Book Now
            </a>
        </div>

    </div>
</div>