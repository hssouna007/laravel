<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $roadmap['title'] }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-900">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Progress Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Your Progress</h3>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div class="bg-indigo-600 h-4 rounded-full" style="width: {{ auth()->user()->getCategoryProgress($category) }}%"></div>
                        </div>
                        <div class="mt-2 text-right">
                            <span class="text-sm text-gray-600">{{ auth()->user()->getCategoryProgress($category) }}% Complete</span>
                        </div>
                    </div>

                    <!-- Steps Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Roadmap Steps</h3>
                        <div class="space-y-4">
                            @foreach($roadmap['steps'] as $index => $step)
                                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                                    <div class="flex-shrink-0 w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <span class="text-indigo-600 font-medium">{{ $index + 1 }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $step['title'] }}</h4>
                                        <p class="text-gray-600 mt-1">{{ $step['description'] }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <button class="text-indigo-600 hover:text-indigo-900">
                                            Mark Complete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Resources Section -->
                    <div>
                        <h3 class="text-lg font-medium mb-4">Resources</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($roadmap['resources'] as $resource)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <h4 class="font-medium text-gray-900">{{ $resource['title'] }}</h4>
                                    <a href="{{ $category === 'english_b2' ? route('goals.show', 'english_b2') : $resource['url'] }}" class="text-indigo-600 hover:text-indigo-900 mt-2 inline-block">
                                        View Resource
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>