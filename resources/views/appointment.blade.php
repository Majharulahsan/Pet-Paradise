{{-- resources/views/appointment.blade.php --}}

@extends('layouts.app')

@section('title', 'Book Appointment')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <a href="{{ route('services') }}" class="flex items-center text-gray-500 hover:text-gray-700 transition mb-8">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Back to Services
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Booking Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 sticky top-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Booking Summary</h2>
                
                <div class="space-y-1 mb-6 border-b pb-4">
                    <p class="text-sm text-gray-500">Selected Service</p>
                    <h3 class="text-lg font-semibold text-gray-800">Basic Grooming</h3>
                    <div class="flex items-center text-sm text-gray-600 space-x-1">
                        <svg class="w-4 h-4 text-[#f97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                        <span>1-2 hours</span>
                    </div>
                    <p class="text-xl font-bold text-[#f97316]">৳5,400</p>
                </div>

                <h4 class="font-semibold text-gray-700 mb-3">Includes:</h4>
                <ul class="space-y-2 text-gray-600 text-sm">
                    <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Bath with premium shampoo</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Brush out and de-shedding</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nail trim</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Ear cleaning</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Paw pad trim</li>
                </ul>
            </div>
        </div>

        <!-- Right Column: Appointment Form -->
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Schedule Your Appointment</h2>

                <form action="#" method="POST">
                    <!-- 1. Date and Time Selection -->
                    <div class="mb-10">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Select Date</h3>
                        <!-- Calendar Widget (Mockup based on image) -->
                        <div class="p-4 border border-gray-200 rounded-xl max-w-sm mx-auto shadow-inner">
                            <div class="flex justify-between items-center mb-4">
                                <button type="button" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                </button>
                                <span class="font-medium text-lg text-gray-900">December 2025</span>
                                <button type="button" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-500 mb-2">
                                <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                                {{-- Mock Calendar Days --}}
                                @php
                                    $days = [30, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 1, 2, 3];
                                @endphp
                                @foreach($days as $day)
                                    <button type="button" class="p-2 rounded-lg transition 
                                        {{ $day < 7 ? 'text-gray-400' : '' }}
                                        {{ $day == 16 ? 'bg-gray-900 text-white font-bold' : 'text-gray-700 hover:bg-gray-100' }}
                                        {{ $day > 31 ? 'text-gray-400' : '' }}
                                        ">
                                        {{ $day }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Select Time</h3>
                        <div class="grid grid-cols-3 gap-3">
                            {{-- Mock Time Slots --}}
                            @php
                                $slots = ['09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM'];
                            @endphp
                            @foreach($slots as $slot)
                                <button type="button" class="time-slot-button p-3 rounded-xl border border-gray-300 text-gray-700 transition hover:bg-orange-50 hover:border-[#f97316]">
                                    {{ $slot }}
                                </button>
                            @endforeach
                            <script>
                                // Simple JS for selecting time slot (for UI demo)
                                document.querySelectorAll('.time-slot-button').forEach(btn => {
                                    btn.addEventListener('click', () => {
                                        document.querySelectorAll('.time-slot-button').forEach(b => b.classList.remove('bg-[#f97316]', 'text-white', 'border-transparent'));
                                        btn.classList.add('bg-[#f97316]', 'text-white', 'border-transparent');
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <!-- 2. Pet Information -->
                    <div class="mb-10 p-6 rounded-2xl bg-orange-50 shadow-inner">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Pet Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="pet_name" class="block text-sm font-medium text-gray-700">Pet Name <span class="text-red-500">*</span></label>
                                <input type="text" id="pet_name" name="pet_name" placeholder="Enter your pet's name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-[#f97316] focus:border-[#f97316]">
                            </div>
                            <div>
                                <label for="pet_type" class="block text-sm font-medium text-gray-700">Pet Type <span class="text-red-500">*</span></label>
                                <select id="pet_type" name="pet_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-[#f97316] focus:border-[#f97316]">
                                    <option value="">Select pet type</option>
                                    <option value="dog">Dog</option>
                                    <option value="cat">Cat</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="pet_breed" class="block text-sm font-medium text-gray-700">Breed</label>
                                <input type="text" id="pet_breed" name="pet_breed" placeholder="e.g. Golden Retriever" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-[#f97316] focus:border-[#f97316]">
                            </div>
                            <div>
                                <label for="pet_age" class="block text-sm font-medium text-gray-700">Age</label>
                                <input type="text" id="pet_age" name="pet_age" placeholder="e.g. 2 years" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-[#f97316] focus:border-[#f97316]">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Your Information -->
                    <div class="mb-10 p-6 rounded-2xl bg-pink-50 shadow-inner">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Your Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" id="full_name" name="full_name" placeholder="Enter your name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" placeholder="your.email@example.com" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone_number" name="phone_number" placeholder="(555) 123-4567" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-3 focus:ring-pink-500 focus:border-pink-500">
                        </div>
                    </div>

                    <!-- 4. Additional Notes -->
                    <div class="mb-10">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Additional Notes</h3>
                        <textarea id="notes" name="notes" rows="3" placeholder="Any special requirements or concerns?" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-4 bg-gray-50 focus:ring-[#f97316] focus:border-[#f97316]"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 btn-primary text-white text-xl font-bold rounded-xl shadow-lg hover:shadow-xl transition">
                        Book Appointment - ₹5,400
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection