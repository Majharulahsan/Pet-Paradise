@extends('layouts.app')

@section('title', 'Our Services - Grooming, Health, & Daycare')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Service Page Header -->
    <div class="mb-12">
        <a href="{{ route('home') }}" class="flex items-center text-gray-500 hover:text-gray-700 transition mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Home
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left Content: Introduction and Stats -->
            <div class="lg:pr-12">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-[#f97316] bg-orange-100 rounded-full mb-3">Professional Pet Care</span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                    Pet Grooming Services
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Professional grooming services to keep your pet looking and feeling their best. We offer everything 
                    from basic hygiene to ultimate spa treatments.
                </p>

                <!-- Key Metrics/Stats (Based on user image) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                    <div class="text-center p-3 rounded-xl bg-orange-50">
                        <p class="text-2xl font-bold text-[#f97316]">15+ Years</p>
                        <p class="text-sm text-gray-600">Experience</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-orange-50">
                        <p class="text-2xl font-bold text-[#f97316]">50+ Experts</p>
                        <p class="text-sm text-gray-600">Professional Staff</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-orange-50">
                        <p class="text-2xl font-bold text-[#f97316]">100% Safe</p>
                        <p class="text-sm text-gray-600">Certified Care</p>
                    </div>
                    <div class="text-center p-3 rounded-xl bg-orange-50">
                        <p class="text-2xl font-bold text-[#f97316]">4.9 Rating</p>
                        <p class="text-sm text-gray-600">2,500+ Reviews</p>
                    </div>
                </div>
            </div>

            <!-- Right Content: Image Placeholder -->
            <div class="bg-gray-100 h-96 rounded-2xl shadow-xl flex items-center justify-center p-8">
                <div class="w-24 h-24 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Tabs Navigation -->
    <div class="flex justify-center mb-10">
        <div id="service-tabs" class="inline-flex space-x-2 p-2 bg-gray-200 rounded-full shadow-inner">
            <button data-target="grooming" class="tab-button active-tab transition duration-300 flex items-center px-4 py-2 rounded-full text-sm font-medium text-gray-900 bg-white shadow-md">
                <span class="mr-2">✂️</span> Grooming
            </button>
            <button data-target="health" class="tab-button transition duration-300 flex items-center px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-gray-900">
                <span class="mr-2">⚕️</span> Health
            </button>
            <button data-target="vet" class="tab-button transition duration-300 flex items-center px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-gray-900">
                <span class="mr-2">🩺</span> Vet
            </button>
            <button data-target="daycare" class="tab-button transition duration-300 flex items-center px-4 py-2 rounded-full text-sm font-medium text-gray-600 hover:text-gray-900">
                <span class="mr-2">🏡</span> Daycare
            </button>
        </div>
    </div>

    <!-- Service Content Sections -->
    <div id="service-content">

        <!-- 1. GROOMING SERVICES -->
        <div id="grooming-content" class="tab-content active-content">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Card 1: Basic Grooming --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Basic Grooming</h3>
                    <p class="text-gray-600 mb-4">Essential grooming services to keep your pet clean and comfortable.</p>
                    
                    <div class="text-sm text-gray-500 mb-4 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#f97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                        <span>1-2 hours</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳5,400</p>

                    <h4 class="font-semibold text-gray-700 mb-2">Includes:</h4>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Bath with premium shampoo</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Brush out and de-shedding</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nail trim</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Ear cleaning</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Paw pad trim</li>
                    </ul>

                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'basic-grooming']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
                
                {{-- Card 2: Deluxe Grooming (Most Popular) --}}
                <div class="bg-white p-6 rounded-2xl shadow-2xl border-4 border-[#f97316] relative transform scale-105">
                    <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full">Most Popular</span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Deluxe Grooming</h3>
                    <p class="text-gray-600 mb-4">Complete grooming package for the pampered pet.</p>

                    <div class="text-sm text-gray-500 mb-4 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#f97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                        <span>2-3 hours</span>
                    </div>
                    <p class="text-3xl font-bold text-[#f97316] mb-6">৳9,000</p>
                    
                    <h4 class="font-semibold text-gray-700 mb-2">Includes:</h4>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> **Everything in Basic Grooming**</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Full haircut/styling</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Teeth brushing</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Face & paw trim</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Cologne spritz</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Bandana or bow tie</li>
                    </ul>
                    
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'deluxe-grooming']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
                
                {{-- Card 3: Spa Treatment --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Spa Treatment</h3>
                    <p class="text-gray-600 mb-4">Ultimate luxury spa experience for your beloved pet.</p>

                    <div class="text-sm text-gray-500 mb-4 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#f97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                        <span>3-4 hours</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳14,400</p>
                    
                    <h4 class="font-semibold text-gray-700 mb-2">Includes:</h4>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Everything in Deluxe Grooming</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Deep conditioning treatment</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Blueberry facial</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Paw pad moisturizing</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Aromatherapy massage</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Professional photo session</li>
                    </ul>

                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'spa-treatment']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
            </div>
        </div>
        
        <!-- 2. HEALTH SERVICES (Initially Hidden) -->
        <div id="health-content" class="tab-content hidden">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Comprehensive Wellness Programs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1: Wellness Exam --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200 relative">
                    <span class="absolute top-0 right-0 -mt-3 -mr-3 px-3 py-1 text-xs font-bold text-white bg-red-600 rounded-full">Most Popular</span>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Wellness Exam</h3>
                    <p class="text-gray-600 mb-4">Comprehensive health checkup for your pet.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳6,600</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'wellness-exam']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 2: Vaccination Package --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Vaccination Package</h3>
                    <p class="text-gray-600 mb-4">Keep your pet protected with essential vaccinations.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳4,200</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'vaccination-package']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
                {{-- Card 3: Senior Pet Care --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Senior Pet Care</h3>
                    <p class="text-gray-600 mb-4">Specialized care for aging pets.</p>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳10,200</p>
                    {{-- FIX: Added explicit bg-[#f97316] and hover:bg-orange-700 classes --}}
                    <a href="{{ route('appointment.index', ['service' => 'senior-pet-care']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl hover:bg-orange-700">Book Now</a>
                </div>
            </div>
        </div>
        
        <!-- 3. VET SERVICES (Initially Hidden) -->
        <div id="vet-content" class="tab-content hidden">
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

        <!-- 4. DAYCARE SERVICES (Initially Hidden) -->
        <div id="daycare-content" class="tab-content hidden">
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
</div>

@push('scripts')
<script>
    // JavaScript to handle the tab switching functionality
    document.addEventListener('DOMContentLoaded', () => {
        const tabButtons = document.querySelectorAll('.tab-button');
        const contentSections = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.dataset.target;

                // Remove active class from all buttons and content
                tabButtons.forEach(btn => {
                    btn.classList.remove('active-tab', 'bg-white', 'shadow-md', 'text-gray-900');
                    btn.classList.add('text-gray-600', 'hover:text-gray-900');
                });
                contentSections.forEach(content => {
                    content.classList.add('hidden');
                });

                // Add active class to the clicked button and show content
                button.classList.add('active-tab', 'bg-white', 'shadow-md', 'text-gray-900');
                button.classList.remove('text-gray-600', 'hover:text-gray-900');
                
                const targetContent = document.getElementById(targetId + '-content');
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            });
        });

        // Ensure initial state is correct (Grooming is active)
        const initialButton = document.querySelector('.tab-button[data-target="grooming"]');
        if (initialButton) {
            initialButton.click();
        }
    });
</script>
@endpush
@endsection