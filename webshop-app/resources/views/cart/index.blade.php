<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($cart->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Your cart is empty</h3>
                            <p class="mt-2 text-gray-500">Add some products to get started!</p>
                            <a href="{{ route('home') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                                Continue Shopping
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($cart as $item)
                                <div class="flex items-center border-b pb-4">
                                    <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://picsum.photos/100/100?random=' . $item['id'] }}"
                                         alt="{{ $item['name'] }}"
                                         class="w-20 h-20 object-cover rounded">

                                    <div class="ml-4 flex-1">
                                        <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                        <p class="text-gray-600">€{{ number_format($item['price'] / 100, 2) }}</p>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item['quantity'] }}"
                                                   min="1"
                                                   class="w-20 px-3 py-2 border rounded"
                                                   onchange="this.form.submit()">
                                        </form>

                                        <div class="text-lg font-bold">
                                            €{{ number_format(($item['price'] * $item['quantity']) / 100, 2) }}
                                        </div>

                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 border-t pt-6">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-2xl font-bold">Total:</span>
                                <span class="text-2xl font-bold text-indigo-600">{{ $formattedTotal }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Clear Cart</button>
                                </form>

                                <div class="space-x-4">
                                    <a href="{{ route('home') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded">
                                        Continue Shopping
                                    </a>
                                    @auth
                                        <a href="{{ route('checkout.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded">
                                            Proceed to Checkout
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded">
                                            Login to Checkout
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
