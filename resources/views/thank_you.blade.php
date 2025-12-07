@extends('layouts.app')

@section('title', 'Thank You for Your Order')

@section('content')
    <div class="container mx-auto py-16 text-center">
        <svg class="w-20 h-20 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Thank You!</h1>
        <p class="text-xl text-gray-600 mb-8">Your order has been placed successfully.</p>
        
        <a href="{{ route('home') }}" 
        class="inline-flex items-center justify-center 
          px-8 py-4 
          bg-orange-600 text-white text-lg font-bold 
          rounded-xl 
          hover:bg-orange-700 
          transition duration-300 
          shadow-lg hover:shadow-xl hover:-translate-y-0.5">
    
    <i class="fa-solid fa-house-chimney mr-2"></i>
    Back to Home Page
</a>
    </div>
@endsection