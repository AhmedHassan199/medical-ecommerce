<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Product Image -->
                        <div class="md:w-1/3">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">No Image Available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="md:w-2/3">
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                                <p class="text-gray-500">{{ $product->category->name }}</p>
                            </div>

                            <div class="mb-6">
                                <p class="text-gray-700">{{ $product->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-sm text-gray-500">Price</p>
                                    <p class="text-xl font-semibold">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Created At</p>
                                    <p class="text-sm">{{ $product->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Updated</p>
                                    <p class="text-sm">{{ $product->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>

                           <div class="flex space-x-4">
                                @if(auth()->check() && auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        إدارة المنتجات
                                    </a>
                                @else
                                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
Products Back                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
