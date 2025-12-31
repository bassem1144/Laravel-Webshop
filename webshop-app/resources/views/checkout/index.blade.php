<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Checkout Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Shipping Information</h3>

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Shipping Address</label>
                                <textarea name="shipping_address"
                                          id="shipping_address"
                                          rows="4"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                <select name="payment_method"
                                        id="payment_method"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    <option value="">Select payment method</option>
                                    <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Order Notes (Optional)</label>
                                <textarea name="notes"
                                          id="notes"
                                          rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                          placeholder="Any special instructions?">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Order Summary</h3>

                        <div class="space-y-3">
                            @foreach($cart as $item)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                                    <span class="font-medium">€{{ number_format(($item['price'] * $item['quantity']) / 100, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t mt-4 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold">Total:</span>
                                <span class="text-2xl font-bold text-indigo-600">{{ $formattedTotal }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded">
                            <p class="text-sm text-yellow-800">
                                <strong>Note:</strong> This is a demo. Payment will be simulated on the next page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
