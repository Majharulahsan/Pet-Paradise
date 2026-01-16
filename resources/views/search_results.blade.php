@extends('layouts.app')

@section('title', 'Search Results for "' . $query . '"')

@section('content')
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-6">Search Results for: "{{ $query }}"</h1>

        @if ($hasResults)
            <p class="text-gray-600 mb-8">{{ $results->count() }} item(s) found.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($results as $product)
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <a href="{{ route('product.detail', ['id' => $product['id']]) }}">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $product['name'] }}</h2>
                            <p class="text-lg font-bold text-brand-orange mt-2">৳{{ number_format($product['price']) }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-xl text-gray-500">No products found matching **"{{ $query }}"**.</p>
                <a href="{{ route('shop') }}" class="mt-4 inline-block text-brand-orange hover:underline">Browse all products</a>
            </div>
        @endif
    </div>
@endsection