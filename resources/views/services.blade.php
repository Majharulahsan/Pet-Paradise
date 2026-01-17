@extends('layouts.app')

@section('title', 'Our Services - Grooming, Health, & Daycare')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- HEADER SECTION: Remains the same visually --}}
    <div class="mb-12">
        <a href="{{ route('home') }}" class="flex items-center text-gray-500 hover:text-gray-700 transition mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Home
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="lg:pr-12">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-[#f97316] bg-orange-100 rounded-full mb-3">Professional Pet Care</span>
                
                {{-- DYNAMIC TITLE: Changes based on which route is active --}}
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                    Pet {{ ucfirst($activeTab) }} Services
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Professional services to keep your pet looking and feeling their best.
                </p>
            </div>
            <div class="bg-gray-100 h-96 rounded-2xl shadow-xl flex items-center justify-center p-8">
                {{-- Placeholder for Image --}}
                <div class="w-24 h-24 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- NAVIGATION TABS: Now using actual <a> links instead of <button> --}}
    <div class="flex justify-center mb-10">
        <div class="inline-flex space-x-2 p-2 bg-gray-200 rounded-full shadow-inner">
            
            {{-- 
                PHP LOGIC: We check if $activeTab matches the service. 
                If yes, we apply 'bg-white shadow-md' to make it look active.
            --}}
            <a href="{{ route('services') }}" 
               class="flex items-center px-4 py-2 rounded-full text-sm font-medium transition {{ $activeTab == 'grooming' ? 'bg-white shadow-md text-gray-900' : 'text-gray-600' }}">
                <span class="mr-2">✂️</span> Grooming
            </a>

            <a href="{{ route('services.health') }}" 
               class="flex items-center px-4 py-2 rounded-full text-sm font-medium transition {{ $activeTab == 'health' ? 'bg-white shadow-md text-gray-900' : 'text-gray-600' }}">
                <span class="mr-2">⚕️</span> Health
            </a>

            <a href="{{ route('services.vet') }}" 
               class="flex items-center px-4 py-2 rounded-full text-sm font-medium transition {{ $activeTab == 'vet' ? 'bg-white shadow-md text-gray-900' : 'text-gray-600' }}">
                <span class="mr-2">🩺</span> Vet
            </a>

            <a href="{{ route('services.daycare') }}" 
               class="flex items-center px-4 py-2 rounded-full text-sm font-medium transition {{ $activeTab == 'daycare' ? 'bg-white shadow-md text-gray-900' : 'text-gray-600' }}">
                <span class="mr-2">🏡</span> Daycare
            </a>
        </div>
    </div>

    <!-- Service Content Sections -->
   <div id="service-content">

    {{-- START: The conditional logic must start with @if --}}
    @if($activeTab == 'grooming')

        <div id="grooming-content">
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

                    <a href="{{ route('appointment.index', ['service' => 'basic-grooming']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
                
                {{-- Card 2: Deluxe Grooming --}}
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
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Everything in Basic</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Full haircut/styling</li>
                        <li class="flex items-center"><svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Teeth brushing</li>
                    </ul>
                    
                    <a href="{{ route('appointment.index', ['service' => 'deluxe-grooming']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
                
                {{-- Card 3: Spa Treatment --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Spa Treatment</h3>
                    <p class="text-gray-600 mb-4">Ultimate luxury spa experience for your pet.</p>

                    <div class="text-sm text-gray-500 mb-4 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#f97316]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path></svg>
                        <span>3-4 hours</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-6">৳14,400</p>

                    <a href="{{ route('appointment.index', ['service' => 'spa-treatment']) }}" class="block w-full mt-8 py-3 text-center bg-[#f97316] text-white font-semibold rounded-xl shadow-lg hover:bg-orange-700 hover:shadow-xl transition">Book Now</a>
                </div>
            </div>
        </div>

    @elseif($activeTab == 'health')
        {{-- Includes the health partial --}}
        @include('partials._health')

    @elseif($activeTab == 'vet')
        {{-- Includes the vet partial --}}
        @include('partials._vet')

    @elseif($activeTab == 'daycare')
        {{-- Includes the daycare partial --}}
        @include('partials._daycare')

    @endif
</div>

</div> 


@endsection