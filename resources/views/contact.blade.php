@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Section -->
        <header class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                Get In Touch
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </header>

        <!-- Contact Cards Section -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Card 1: Visit Us (Location) -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                <div class="w-12 h-12 bg-orange-50 rounded-xl mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-location-dot text-orange-500 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Visit Us</h3>
                <p class="text-gray-500 mb-4 text-sm">Our main office and clinic location.</p>
                <div class="text-gray-700 text-sm">
                    <p>123 Pet Street, Gulshan-1</p>
                    <p>Dhaka-1212, Bangladesh</p>
                </div>
            </div>

            <!-- Card 2: Call Us (Phone) -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                <div class="w-12 h-12 bg-pink-50 rounded-xl mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-phone text-pink-500 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Call Us</h3>
                <p class="text-gray-500 mb-4 text-sm">Reach our customer support or veterinary team.</p>
                <div class="text-gray-700 text-sm">
                    <p>+880 1234-567890</p>
                    <p>+880 9876-543210 (Vet Emergency)</p>
                </div>
            </div>

            <!-- Card 3: Email Us (Email) -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                <div class="w-12 h-12 bg-purple-50 rounded-xl mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-envelope text-purple-500 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Email Us</h3>
                <p class="text-gray-500 mb-4 text-sm">Send general inquiries or support requests.</p>
                <div class="text-gray-700 text-sm">
                    <p>info@petparadise.com</p>
                    <p>support@petparadise.com</p>
                </div>
            </div>

            <!-- Card 4: Business Hours (Clock) -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                <div class="w-12 h-12 bg-blue-50 rounded-xl mb-4 flex items-center justify-center">
                    <i class="fa-solid fa-clock text-blue-500 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-1">Business Hours</h3>
                <p class="text-gray-500 mb-4 text-sm">When we are open for business and appointments.</p>
                <div class="text-gray-700 text-sm">
                    <p>Mon-Sat: 9:00 AM - 8:00 PM</p>
                    <p>Sunday: 10:00 AM - 6:00 PM</p>
                </div>
            </div>
        </section>

        <!-- Optional: Contact Form (Uncomment to include a form) -->
        {{-- <section class="mt-16 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Send Us a Message</h2>
            <form action="#" method="POST" class="max-w-2xl mx-auto space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required
                           class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Your Message</label>
                    <textarea id="message" name="message" rows="4" required
                              class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-orange-500 focus:ring-orange-500 p-3"></textarea>
                </div>
                <div class="pt-4">
                    <button type="submit"
                            class="w-full py-3 px-4 border border-transparent rounded-xl shadow-sm text-lg font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150">
                        Send Message
                    </button>
                </div>
            </form>
        </section> --}}

    </div>
@endsection