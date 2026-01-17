@extends('layouts.app')

@section('title', 'Thank You for Your Order')

@section('content')
    <div class="max-w-3xl mx-auto py-16 px-4">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-green-50 p-8 text-center border-b border-green-100">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Order Confirmed!</h1>
                <p class="text-green-700 font-medium">Thank you for shopping with Pet Paradise.</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-2">Order Number</h3>
                        <p class="text-xl font-mono font-bold text-gray-800">
                            #{{ session('order_id') ?? 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-gray-400 uppercase text-xs font-bold tracking-widest mb-2">Total Amount Paid</h3>
                        <p class="text-xl font-bold text-orange-600">
                            ৳{{ number_format(session('grand_total') ?? 0) }}
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-4 mb-8 flex items-start gap-3">
                    <i class="lucide-info text-blue-500 mt-1"></i>
                    <p class="text-sm text-gray-600">
                        {{ session('success') ?? 'Your order has been received and is being processed by our team. You will receive an email confirmation shortly.' }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('home') }}" 
                       class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-orange-600 text-white text-lg font-bold rounded-xl hover:bg-orange-700 transition duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <i class="lucide-home mr-2"></i>
                        Back to Shopping
                    </a>
                    
                    <button onclick="window.print()" 
                            class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 text-lg font-bold rounded-xl hover:bg-gray-200 transition duration-300">
                        <i class="lucide-printer mr-2"></i>
                        Print Receipt
                    </button>
                </div>
            </div>

            <div class="bg-gray-50 p-6 text-center border-t border-gray-100">
                <p class="text-gray-500 text-sm">Need help? <a href="#" class="text-orange-600 underline">Contact Support</a></p>
            </div>
        </div>
    </div>
@endsection