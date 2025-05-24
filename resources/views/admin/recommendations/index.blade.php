<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AI Recommendations for Product Promotion') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">AI Recommendations</h2>

                    <form action="{{ route('admin.recommendations.show') }}" method="GET">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Get Recommendations
                        </button>
                    </form>
                </div>
                 @if(!empty($recommendations))
                    <ul class="list-disc list-inside text-gray-600">
                        @foreach($recommendations as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No recommendations available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
