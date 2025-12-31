<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Simulation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-6">
                        <svg class="mx-auto h-16 w-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <h3 class="mt-4 text-2xl font-bold">Payment Processing</h3>
                        <p class="mt-2 text-gray-600">Order #{{ $order->id }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Payment Method:</span>
                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Total Amount:</span>
                            <span class="font-medium text-xl text-indigo-600">{{ $order->formatted_total }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-sm text-yellow-800">
                            <strong>⚠️ This is a simulated payment gateway for demo purposes.</strong><br>
                            Click "Complete Payment" to simulate a successful payment, or "Cancel" to simulate a failed payment.
                        </p>
                    </div>

                    <div class="flex space-x-4">
                        <form action="{{ route('checkout.processPayment', $order) }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="action" value="success">
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                                Complete Payment
                            </button>
                        </form>

                        <form action="{{ route('checkout.processPayment', $order) }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="action" value="fail">
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded">
                                Cancel Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
