@extends('layouts.app')

@section('title', 'Home - Pet Paradise')

@section('content')
    <!-- HOMEPAGE VIEW -->
    <section id="home-view" class="pt-12 pb-24">
        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between">
            <!-- Left Content Block -->
            <div class="lg:w-1/2 p-6 space-y-8 max-w-lg lg:max-w-none">
                <p class="text-sm font-semibold text-orange-500 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-400"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                    <span>Welcome to Pet Paradise</span>
                </p>
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Where Every Pet Finds Their Happy Place
                </h1>
                <p class="text-gray-600 text-lg">
                    From premium pet supplies to professional grooming services, we provide everything your furry friends need to live their best life. Experience the difference at Pet Paradise.
                </p>
                <div class="flex space-x-4 pt-4">
                    <a href="{{ route('shop') }}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition duration-300 shadow-xl shadow-orange-200">
                        Shop <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <button class="px-8 py-3 text-base font-medium rounded-xl text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition duration-300 shadow-lg">
                        Our Services
                    </button>
                </div>

                <!-- Stats -->
                <div class="flex space-x-8 pt-8 text-center">
                    <div>
                        <p class="text-2xl font-bold text-orange-600">10,000+</p>
                        <p class="text-sm text-gray-500">Happy Pets</p>
                    </div>
                    <div class="border-l border-gray-200 pl-8">
                        <p class="text-2xl font-bold text-orange-600">500+</p>
                        <p class="text-sm text-gray-500">Products</p>
                    </div>
                    <div class="border-l border-gray-200 pl-8">
                        <p class="text-2xl font-bold text-orange-600">50+</p>
                        <p class="text-sm text-gray-500">Expert Staff</p>
                    </div>
                </div>
            </div>

            <!-- Right Image Block -->
            <div class="lg:w-1/2 relative mt-12 lg:mt-0 flex justify-center lg:justify-end">
                <div class="w-full max-w-md h-96 relative">
                    <img src="https://images.unsplash.com/photo-1719384102559-708d244e84af?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYXBweSUyMGRvZyUyMHBldHxlbnwxfHx8fDE3NjA0Mzk4NDR8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referralhttps://images.unsplash.com/photo-1719384102559-708d244e84af?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYXBweSUyMGRvZyUyMHBldHxlbnwxfHx8fDE3NjA0Mzk4NDR8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral" alt="A happy dog looking at the camera" class="w-full h-full object-cover rounded-[2rem] shadow-2xl ring-4 ring-white/50" loading="lazy">
                    <!-- Rating Overlay -->
                    <div class="absolute bottom-[-1.5rem] right-0 bg-white p-4 rounded-xl shadow-2xl flex items-center space-x-2 transform translate-x-[-15%]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="rating-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <div>
                            <p class="text-lg font-bold">4.9/5 Rating</p>
                            <p class="text-xs text-gray-500">2,500+ Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection