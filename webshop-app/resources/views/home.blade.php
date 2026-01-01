<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('home') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Search products..."
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div class="w-48">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category" id="category"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                                Filter
                            </button>
                            @if(request('search') || request('category'))
                                <a href="{{ route('home') }}"
                                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($products as $product)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow">
                                <img class="w-full h-48 object-cover"
                                     src="{{ $product->image_url }}"
                                     alt="{{ $product->name }}">
                                <div class="p-4">
                                    @if($product->category)
                                        <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded mb-2">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
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
                                <p class="text-gray-500 text-lg">No products found.</p>
                                @if(request('search') || request('category'))
                                    <a href="{{ route('home') }}" class="text-indigo-600 hover:underline mt-2 inline-block">
                                        Clear filters
                                    </a>
                                @endif
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

