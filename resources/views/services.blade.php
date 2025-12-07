@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
    <style>
        .service-hero {
            background: linear-gradient(to right, #fff5f5, #fef2f4);
            /* Soft pink/orange gradient background for the hero */
        }
        .pricing-card-default {
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }
        .pricing-card-popular {
            border: 2px solid #f97316; /* Brand orange border for popular card */
            transform: scale(1.05); /* Slightly bigger for emphasis */
            box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.1), 0 4px 6px -4px rgba(249, 115, 22, 0.1);
        }
        .service-tab.active {
            background-color: #ffffff;
            color: #f97316;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div x-data="{
        // List of all service category keys
        tabs: ['Grooming', 'Health', 'Vet', 'Daycare'],
        // Set initial active tab
        activeTab: 'Grooming',
        // PHP-provided data passed into Alpine.js
        servicesData: @json($services),

        // Computed property to get the cards for the current active tab
        get currentCards() {
            return this.servicesData[this.activeTab] || [];
        },
        // Function to create a clean URL slug from the service name
        slugify(text) {
            return text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        },
        // Function to generate the booking URL
        getBookingUrl(category, serviceName) {
            // Note: PHP variables are used here, as Alpine can't directly use Laravel's route() function.
            // We pass the required parameters to the route: category and slugified service name.
            return '{{ url('book') }}/' + category + '/' + this.slugify(serviceName);
        }
    }">

        <!-- Hero and Information Section -->
        <section class="service-hero rounded-3xl p-8 md:p-12 mb-12">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <span class="inline-flex items-center px-4 py-1 text-sm font-semibold rounded-full bg-orange-100 text-orange-600 mb-4">
                        <i class="fa-solid fa-scissors mr-2"></i> Professional Pet Care
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">
                        A Range of Services for Your Beloved Pet
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Professional grooming, specialized health packages, and comprehensive daycare to ensure your pet is happy, healthy, and looking their absolute best.
                    </p>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
                        <div class="p-3 bg-white rounded-xl shadow-md">
                            <i class="fa-solid fa-calendar-check text-2xl text-orange-500 mb-1"></i>
                            <p class="font-bold text-gray-800">15+ Years</p>
                            <p class="text-xs text-gray-500">Experience</p>
                        </div>
                        <div class="p-3 bg-white rounded-xl shadow-md">
                            <i class="fa-solid fa-user-tie text-2xl text-orange-500 mb-1"></i>
                            <p class="font-bold text-gray-800">50+ Experts</p>
                            <p class="text-xs text-gray-500">Professional Staff</p>
                        </div>
                        <div class="p-3 bg-white rounded-xl shadow-md">
                            <i class="fa-solid fa-heart text-2xl text-orange-500 mb-1"></i>
                            <p class="font-bold text-gray-800">100% Safe</p>
                            <p class="text-xs text-gray-500">Certified Care</p>
                        </div>
                        <div class="p-3 bg-white rounded-xl shadow-md">
                            <i class="fa-solid fa-star text-2xl text-orange-500 mb-1"></i>
                            <p class="font-bold text-gray-800">4.9 Rating</p>
                            <p class="text-xs text-gray-500">2,500+ Reviews</p>
                        </div>
                    </div>
                </div>

                <!-- Mock Image/Illustration -->
                <div class="lg:w-1/2 w-full">
                    <div class="bg-white p-6 rounded-3xl shadow-xl border border-gray-200">
                        <img src="https://images.pexels.com/photos/1805164/pexels-photo-1805164.jpeg"
                             alt="Pet Services Illustration"
                             class="w-full h-auto object-cover rounded-2xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Category Tabs -->
        <div class="flex justify-center mb-10">
            <div class="inline-flex bg-gray-100 p-2 rounded-full shadow-inner space-x-2">
                <template x-for="tab in tabs" :key="tab">
                    <button @click="activeTab = tab"
                            :class="{'active': activeTab === tab, 'text-gray-600 hover:text-orange-600': activeTab !== tab}"
                            class="service-tab px-6 py-2 rounded-full text-sm font-medium transition-colors duration-200 flex items-center gap-2">
                        <!-- Icon for each tab (using Font Awesome) -->
                        <i x-show="tab === 'Grooming'" class="fa-solid fa-paw"></i>
                        <i x-show="tab === 'Health'" class="fa-solid fa-notes-medical"></i>
                        <i x-show="tab === 'Vet'" class="fa-solid fa-user-doctor"></i>
                        <i x-show="tab === 'Daycare'" class="fa-solid fa-house-chimney-crack"></i>
                        <span x-text="tab"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- Pricing Cards Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="card in currentCards" :key="card.name">
                    <div :class="card.popular ? 'pricing-card-popular' : 'pricing-card-default'"
                         class="bg-white p-8 rounded-3xl border border-gray-100 flex flex-col">

                        <!-- Popular Badge -->
                        <div x-show="card.popular" class="mb-4">
                            <span class="inline-block bg-orange-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                Most Popular
                            </span>
                        </div>

                        <!-- Card Header -->
                        <h3 class="text-2xl font-bold text-gray-900 mb-2" x-text="card.name"></h3>
                        <p class="text-gray-500 mb-4" x-text="card.description"></p>

                        <!-- Price and Duration -->
                        <div class="flex items-end mb-6 border-b border-gray-100 pb-4">
                            <span class="text-4xl font-extrabold text-orange-600 mr-2">
                                ৳<span x-text="card.price.toLocaleString('en-IN')"></span>
                            </span>
                            <span class="text-sm text-gray-500" x-text="'(' + card.duration + ')'"></span>
                        </div>

                        <!-- Features -->
                        <div class="flex-1 space-y-3 mb-8">
                            <h4 class="font-semibold text-gray-700">Includes:</h4>
                            <template x-for="item in card.includes" :key="item">
                                <div class="flex items-start text-gray-600">
                                    <i class="fa-solid fa-check text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                                    <span x-text="item"></span>
                                </div>
                            </template>
                        </div>

                        <!-- Book Now Button (UPDATED LINK) -->
                        <a :href="getBookingUrl(activeTab, card.name)"
                            class="mt-auto w-full text-center bg-orange-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-orange-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                            Book Now
                        </a>
                    </div>
                </template>
            </div>
        </section>
    </div>
@endsection