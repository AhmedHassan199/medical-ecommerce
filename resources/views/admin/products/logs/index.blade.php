<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Logs') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="{{ url()->current() }}" class="mb-6">
                    <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Search logs..."
                        class="border border-gray-300 rounded-md p-2 w-full max-w-sm">
                    <button type="submit" class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded">Search</button>
                </form>

            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Changed By</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Changes</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($logs as $log)
                                    <tr>
                                        <td class="px-6 py-4">
                                            {{ $log->product->name ?? 'Deleted Product' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $log->action === 'created' ? 'bg-green-100 text-green-800' :
                                                   ($log->action === 'updated' ? 'bg-blue-100 text-blue-800' :
                                                   'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($log->action) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $log->changedBy->name ?? 'Unknown' }}
                                        </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                            <ul class="list-disc list-inside space-y-1 max-w-md">
             @foreach($log->changes as $field => $change)
                                    @if(is_array($change) && isset($change['old']) && isset($change['new']))
                                        <li>
                                <strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong>
                                <span class="text-red-600 line-through mr-1">{{ is_array($change['old']) ? json_encode($change['old'], JSON_PRETTY_PRINT) : $change['old'] }}</span>
                                →
                                <span class="text-green-600">{{ is_array($change['new']) ? json_encode($change['new'], JSON_PRETTY_PRINT) : $change['new'] }}</span>
                            </li>
            @else
                <li>
                    <strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong>
                    {{ is_array($change) ? json_encode($change) : $change }}
                </li>
            @endif
        @endforeach
    </ul>
</td>

                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $log->created_at->format('Y-m-d H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-gray-500">No logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                       {{ $logs->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
