<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Order Information</h3>
                            <p class="text-sm text-gray-600">Order ID: <span class="font-medium">#{{ $order->id }}</span></p>
                            <p class="text-sm text-gray-600">Date: <span class="font-medium">{{ $order->created_at->format('F d, Y H:i') }}</span></p>
                            <p class="text-sm text-gray-600">Status:
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600">Payment Status:
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->payment_status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </p>
                            <p class="text-sm text-gray-600">Payment Method: <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span></p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-2">Customer Information</h3>
                            @if($order->user)
                                <p class="text-sm text-gray-600">Name: <span class="font-medium">{{ $order->user->name }}</span></p>
                                <p class="text-sm text-gray-600">Email: <span class="font-medium">{{ $order->user->email }}</span></p>
                            @else
                                <p class="text-sm text-gray-600">[Customer information unavailable]</p>
                            @endif

                            <h4 class="text-md font-semibold mt-4 mb-2">Shipping Address</h4>
                            <p class="text-sm text-gray-600 whitespace-pre-line">{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    @if($order->notes)
                        <div class="mb-6 p-4 bg-gray-50 rounded">
                            <h4 class="text-md font-semibold mb-2">Order Notes</h4>
                            <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                        </div>
                    @endif

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Order Items</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($item->product)
                                                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/40' }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="w-10 h-10 rounded object-cover mr-3">
                                                    <span class="font-medium">{{ $item->product->name }}</span>
                                                @else
                                                    <img src="https://via.placeholder.com/40"
                                                         alt="Deleted Product"
                                                         class="w-10 h-10 rounded object-cover mr-3">
                                                    <span class="font-medium text-gray-500">[Product Deleted]</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->formatted_price }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">
                                            {{ $item->formatted_subtotal }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-50">
                                    <td colspan="3" class="px-6 py-4 text-right font-bold">Total:</td>
                                    <td class="px-6 py-4 text-right text-xl font-bold text-indigo-600">{{ $order->formatted_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-800">
                            ← Back to Orders
                        </a>
                        @if($order->payment_status === 'pending')
                            <a href="{{ route('checkout.payment', $order) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                                Complete Payment
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
