<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Goal Details - ') . Str::ucfirst($goal->category) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($goal)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">Goal Information</h3>
                                <p class="text-gray-600"><strong>Category:</strong> {{ Str::ucfirst($goal->category) }}</p>
                                <p class="text-gray-600"><strong>Description:</strong> {{ $goal->description }}</p>
                                <p class="text-gray-600"><strong>Progress:</strong> {{ $goal->progress }}%</p>
                                <p class="text-gray-600"><strong>Deadline:</strong> {{ $goal->deadline ? \Carbon\Carbon::parse($goal->deadline)->format('Y-m-d') : 'N/A' }}</p>
                                <p class="text-gray-600"><strong>Visibility:</strong> {{ Str::ucfirst($goal->visibility) }}</p>
                                <p class="text-gray-600"><strong>Status:</strong> {{ Str::ucfirst($goal->status) }}</p>
                                <p class="text-gray-600"><strong>Current Level:</strong> {{ $goal->current_level ?? 'N/A' }}</p>
                                <p class="text-gray-600"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($goal->start_date)->format('Y-m-d') }}</p>
                                <p class="text-gray-600"><strong>Last Activity:</strong> {{ \Carbon\Carbon::parse($goal->last_activity_at)->format('Y-m-d H:i:s') }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">Location (if set)</h3>
                                <p class="text-gray-600"><strong>Latitude:</strong> {{ $goal->latitude ?? 'N/A' }}</p>
                                <p class="text-gray-600"><strong>Longitude:</strong> {{ $goal->longitude ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('goals.edit', $goal->category) }}" class="mr-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                                Edit Goal
                            </a>
                            <a href="{{ route('goals.roadmap', $goal->category) }}" class="mr-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                View Roadmap
                            </a>
                            <form action="{{ route('goals.destroy', $goal->category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200" onclick="return confirm('Are you sure you want to delete this goal?');">
                                    Delete Goal
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-center text-gray-600">Goal not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>