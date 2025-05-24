<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Revenue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Total Revenue</h3>
                    <p class="text-2xl text-green-600 mt-2 total-revenue">${{ $data['total_revenue'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Change (1 min): <span class="revenue-change text-yellow-500">${{ $data['revenue_change'] }}</span></p>
                </div>

                <!-- Order Count -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Order Count</h3>
                    <p class="text-2xl text-blue-600 mt-2 order-count">{{ $data['order_count'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">New orders in last minute</p>
                </div>

                <!-- Top Products -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800">Top Products</h3>
                    <ul class="mt-4 space-y-2 top-products">
                        @foreach($data['top_products'] as $product)
                            <li class="flex justify-between text-sm text-gray-700">
                                <span>{{ $product->name }}</span>
                                <span class="text-green-500">${{ $product->total_sales }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-gray-500 text-sm mt-10">
            </div>

        </div>
    </div>
</x-app-layout>

@push('scripts')
@vite('resources/js/app.js')

@endpush
