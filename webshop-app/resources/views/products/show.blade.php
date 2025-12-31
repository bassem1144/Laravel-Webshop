<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            <img class="w-full rounded-lg shadow-lg" 
                                 src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                                 alt="{{ $product->name }}">
                        </div>

                        <!-- Product Details -->
                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                            
                            <div class="mb-6">
                                <span class="text-4xl font-bold text-indigo-600">{{ $product->formatted_price }}</span>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Description</h3>
                                <p class="text-gray-700">{{ $product->description }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Availability</h3>
                                @if($product->stock > 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        In Stock ({{ $product->stock }} available)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <div class="flex space-x-4">
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button class="flex-1 bg-gray-400 text-white font-bold py-3 px-6 rounded-lg cursor-not-allowed" disabled>
                                        Out of Stock
                                    </button>
                                @endif
                                
                                <a href="{{ route('home') }}" 
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg transition">
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
