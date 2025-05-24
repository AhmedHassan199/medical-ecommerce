<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Order Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-sm text-gray-500">Full Name</p>
                                    <p class="font-medium">{{ $order->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone Number</p>
                                    <p class="font-medium">{{ $order->phone_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Delivery Address</p>
                                    <p class="font-medium">{{ $order->delivery_address }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Order Date</p>
                                    <p class="font-medium">{{ $order->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Order Status</p>
                                    <p class="font-medium">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' :
                                               ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' :
                                               'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                            <div class="border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($order->items as $item)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Subtotal</td>
                                            <td class="px-4 py-3 text-sm text-gray-500">${{ number_format($order->total_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Shipping</td>
                                            <td class="px-4 py-3 text-sm text-gray-500">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Total</td>
                                            <td class="px-4 py-3 text-sm font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
