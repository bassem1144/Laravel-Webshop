<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Tabs -->
            <div class="mb-4 flex flex-wrap gap-2">
                <a href="{{ route('home', array_filter(request()->except('category'))) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    All ({{ $categories->sum('products_count') }})
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('home', array_merge(request()->except('category'), ['category' => $category->id])) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('category') == $category->id ? 'bg-gray-800 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {{ $category->name }} ({{ $category->products_count }})
                    </a>
                @endforeach
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-4">
                <form action="{{ route('home') }}" method="GET" class="flex flex-wrap items-end gap-4">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif

                    <!-- Sort -->
                    <div class="flex-1 min-w-[200px]">
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select name="sort" id="sort"
                                class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-gray-800 focus:ring-gray-800">
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low-High)</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High-Low)</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </div>

                    <!-- Price Range -->
                    <div class="flex gap-2 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Min (€)</label>
                            <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}"
                                   class="w-24 text-sm rounded-md border-gray-300 shadow-sm focus:border-gray-800 focus:ring-gray-800">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Max (€)</label>
                            <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}"
                                   class="w-24 text-sm rounded-md border-gray-300 shadow-sm focus:border-gray-800 focus:ring-gray-800">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <button type="submit"
                            class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-6 rounded transition">
                        Apply
                    </button>
                    @if(request()->hasAny(['sort', 'min_price', 'max_price']))
                        <a href="{{ route('home', request()->only('category')) }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium py-2 px-6 rounded transition">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Product Grid -->
            <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ $products->total() }} products
                        </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @forelse ($products as $product)
                                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition cursor-pointer"
                                     onclick="window.location='{{ route('products.show', $product) }}'">
                                    <img class="w-full h-48 object-cover"
                                         src="{{ $product->image_url }}"
                                         alt="{{ $product->name }}">
                                    <div class="p-4">
                                        <h5 class="font-bold mb-2">{{ $product->name }}</h5>
                                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 80) }}</p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl font-bold text-gray-900">{{ $product->formatted_price }}</span>
                                            <span class="text-xs {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-3 text-center py-12">
                                    <p class="text-gray-500">No products found.</p>
                                    <a href="{{ route('home') }}" class="text-gray-800 hover:underline mt-2 inline-block text-sm">
                                        Clear filters
                                    </a>
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
    </div>
</x-app-layout>
