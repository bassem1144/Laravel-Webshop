<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($orders->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No orders yet</h3>
                            <p class="mt-2 text-gray-500">Start shopping to see your orders here!</p>
                            <a href="{{ route('home') }}" class="mt-6 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                                Start Shopping
                            </a>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border rounded-lg p-6 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold">Order #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('F d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xl font-bold text-indigo-600">{{ $order->formatted_total }}</p>
                                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                                {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->payment_status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Items:</p>
                                        <div class="space-y-1">
                                            @foreach($order->items as $item)
                                                <div class="flex justify-between text-sm">
                                                    <span>
                                                        @if($item->product)
                                                            {{ $item->product->name }} (x{{ $item->quantity }})
                                                        @else
                                                            <span class="text-gray-500">[Product Deleted]</span> (x{{ $item->quantity }})
                                                        @endif
                                                    </span>
                                                    <span>{{ $item->formatted_subtotal }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">
                                            Status: <span class="font-medium">{{ ucfirst($order->status) }}</span>
                                        </span>
                                        <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
