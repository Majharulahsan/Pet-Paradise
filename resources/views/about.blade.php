@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Section -->
        <header class="text-center mb-16">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                Our Story: Why We Do What We Do
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pet Paradise was founded on a simple belief: every pet deserves the very best. We are a community of dedicated animal lovers committed to providing high-quality products and compassionate services.
            </p>
        </header>

        <!-- Our Values Section (Matching Screenshot) -->
        <section class="mb-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Our Values</h2>
                <p class="text-gray-500">The principles that guide everything we do at Pet Paradise</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value Card: Passionate Care -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-pink-50 rounded-xl mb-4 flex items-center justify-center">
                        <i class="fa-solid fa-heart text-pink-500 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Passionate Care</h3>
                    <p class="text-gray-600 text-sm">
                        We treat every pet as if they were our own, providing compassionate and personalized care.
                    </p>
                </div>

                <!-- Value Card: Excellence -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-orange-50 rounded-xl mb-4 flex items-center justify-center">
                        <i class="fa-solid fa-star text-orange-500 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Excellence</h3>
                    <p class="text-gray-600 text-sm">
                        Committed to the highest standards in pet care products, and customer service.
                    </p>
                </div>

                <!-- Value Card: Community -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-purple-50 rounded-xl mb-4 flex items-center justify-center">
                        <i class="fa-solid fa-users text-purple-500 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community</h3>
                    <p class="text-gray-600 text-sm">
                        Building a supportive community of pet lovers who share our passion for animal welfare.
                    </p>
                </div>

                <!-- Value Card: Trust -->
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-xl mb-4 flex items-center justify-center">
                        <i class="fa-solid fa-shield-halved text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Trust</h3>
                    <p class="text-gray-600 text-sm">
                        Your trust is our priority. We ensure safety, quality, and transparency in everything we do.
                    </p>
                </div>
            </div>
        </section>

        <!-- Key Statistics Section (Matching Screenshot) -->
        <section class="bg-gradient-to-r from-orange-600 to-pink-600 p-8 rounded-2xl shadow-2xl">
            <div class="grid grid-cols-2 md:grid-cols-4 text-white text-center gap-6">

                <!-- Stat 1: Happy Pets -->
                <div>
                    <p class="text-4xl font-extrabold mb-1">10,000+</p>
                    <p class="text-lg font-medium">Happy Pets Served</p>
                </div>

                <!-- Stat 2: Premium Products -->
                <div>
                    <p class="text-4xl font-extrabold mb-1">500+</p>
                    <p class="text-lg font-medium">Premium Products</p>
                </div>

                <!-- Stat 3: Expert Staff -->
                <div>
                    <p class="text-4xl font-extrabold mb-1">50+</p>
                    <p class="text-lg font-medium">Expert Staff</p>
                </div>

                <!-- Stat 4: Years of Service -->
                <div>
                    <p class="text-4xl font-extrabold mb-1">14+</p>
                    <p class="text-lg font-medium">Years of Service</p>
                </div>

            </div>
        </section>

    </div>
@endsection