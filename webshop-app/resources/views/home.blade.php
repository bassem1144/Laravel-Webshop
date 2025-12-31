<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($products as $product)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                                <img class="w-full h-48 object-cover"
                                     src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                     alt="{{ $product->name }}">
                                <div class="p-4">
                                    <h5 class="text-xl font-bold mb-2">{{ $product->name }}</h5>
                                    <p class="text-gray-700 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-indigo-600">{{ $product->formatted_price }}</span>
                                        <span class="text-sm text-gray-500">Stock: {{ $product->stock }}</span>
                                    </div>
                                    <a href="{{ route('products.show', $product) }}"
                                       class="mt-4 w-full inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <p class="text-gray-500 text-lg">No products available.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

