<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:text-indigo-900">
                    Complete Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Your Goals</h3>
                        <a href="{{ route('goals.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out">
                            Add New Goal
                        </a>
                    </div>

                    <!-- Debug: Display goals in a styled table -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg shadow-inner">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Debug: Goals Data</h4>
                        @if(!isset($goals) || $goals->isEmpty())
                            <div class="text-gray-500 italic">No goals available to display.</div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                                    <thead class="text-xs uppercase bg-gray-200 text-gray-600">
                                        <tr>
                                            <th class="px-4 py-2 border-b">ID</th>
                                            <th class="px-4 py-2 border-b">User ID</th>
                                            <th class="px-4 py-2 border-b">Category</th>
                                            <th class="px-4 py-2 border-b">Description</th>
                                            <th class="px-4 py-2 border-b">Progress</th>
                                            <th class="px-4 py-2 border-b">Deadline</th>
                                            <th class="px-4 py-2 border-b">Visibility</th>
                                            <th class="px-4 py-2 border-b">Status</th>
                                            <th class="px-4 py-2 border-b">Current Level</th>
                                            <th class="px-4 py-2 border-b">Start Date</th>
                                            <th class="px-4 py-2 border-b">Last Activity</th>
                                            <th class="px-4 py-2 border-b">Created At</th>
                                            <th class="px-4 py-2 border-b">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($goals as $goal)
                                            <tr class="bg-white hover:bg-gray-50 transition-colors">
                                                <td class="px-4 py-2 border-b">{{ $goal->id }}</td>
                                                <td class="px-4 py-2 border-b">{{ $goal->user_id }}</td>
                                                <td class="px-4 py-2 border-b capitalize">{{ $goal->category }}</td>
                                                <td class="px-4 py-2 border-b">{{ $goal->description }}</td>
                                                <td class="px-4 py-2 border-b">{{ $goal->progress }}%</td>
                                                <td class="px-4 py-2 border-b">{{ $goal->deadline ? \Carbon\Carbon::parse($goal->deadline)->format('Y-m-d') : 'N/A' }}</td>
                                                <td class="px-4 py-2 border-b capitalize">{{ $goal->visibility }}</td>
                                                <td class="px-4 py-2 border-b capitalize">{{ $goal->status }}</td>
                                                <td class="px-4 py-2 border-b capitalize">{{ $goal->current_level ?? 'N/A' }}</td>
                                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($goal->start_date)->format('Y-m-d') }}</td>
                                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($goal->last_activity_at)->format('Y-m-d H:i:s') }}</td>
                                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($goal->created_at)->format('Y-m-d H:i:s') }}</td>
                                                <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($goal->updated_at)->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    @php
                        $categoryDetails = [
                            'running' => [
                                'title' => 'Running',
                                'description' => 'Improve your running performance and endurance',
                                'color' => 'bg-green-600',
                            ],
                            'english_b2' => [
                                'title' => 'English B2',
                                'description' => 'Achieve B2 level proficiency in English',
                                'color' => 'bg-blue-600',
                            ],
                            'trading' => [
                                'title' => 'Trading',
                                'description' => 'Master trading strategies and market analysis',
                                'color' => 'bg-purple-600',
                            ],
                        ];
                    @endphp

                    @if(!isset($goals) || $goals->isEmpty())
                        <div class="text-center py-8 text-gray-600 bg-gray-50 rounded-lg">
                            You haven't added any goals yet. Start by adding a new goal!
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($goals as $goal)
                                @php
                                    $categoryDetail = $categoryDetails[$goal->category] ?? $categoryDetails['running'];
                                @endphp
                                <div class="bg-white shadow-md hover:shadow-lg transition-shadow duration-300 rounded-lg overflow-hidden border border-gray-200">
                                    <div class="p-6">
                                        <h3 class="text-lg font-semibold mb-3 {{ $categoryDetail['color'] }} text-white py-2 px-4 rounded-t-lg">
                                            {{ $categoryDetail['title'] }}
                                        </h3>
                                        <p class="text-gray-700 mb-4 line-clamp-2">{{ $goal->description }}</p>
                                        <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                            <div class="h-4 rounded-full {{ $categoryDetail['color'] }} text-xs text-white flex items-center justify-center transition-all duration-300" style="width: {{ $goal->progress }}%" title="{{ $goal->progress }}%">
                                                {{ $goal->progress }}%
                                            </div>
                                        </div>
                                        <div class="flex space-x-4 text-sm">
                                            <a href="{{ route('goals.show', $goal->category) }}" class="text-indigo-600 hover:text-indigo-800 underline">
                                                View Details
                                            </a>
                                            <a href="{{ route('goals.roadmap', $goal->category) }}" class="text-indigo-600 hover:text-indigo-800 underline">
                                                View Roadmap
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>