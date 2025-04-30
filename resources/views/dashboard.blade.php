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
            <!-- Profile Completion Alert -->
            @if(!auth()->user()->profile_completed)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Please complete your profile to get personalized goal recommendations and track your progress effectively.
                                <a href="{{ route('profile.edit') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Complete Profile
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div x-data="{ 
                        goals: [],
                        loading: true,
                        async init() {
                            await this.loadGoals();
                            this.loading = false;
                        },
                        async loadGoals() {
                            try {
                                const response = await fetch('/api/goals');
                                this.goals = await response.json();
                            } catch (error) {
                                console.error('Error loading goals:', error);
                            }
                        }
                    }">
                        <!-- Loading State -->
                        <div x-show="loading" class="text-center py-4">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-gray-300 border-t-blue-600"></div>
                        </div>

                        <!-- Goals Section -->
                        <div x-show="!loading" class="space-y-6">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium">Your Goals</h3>
                                <a href="{{ route('goals.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    Add New Goal
                                </a>
                            </div>

                            <!-- Goal Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Running Goal -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6">
                                        <h3 class="text-lg font-medium mb-2">Running</h3>
                                        <p class="text-gray-600 mb-4">Improve your running performance and endurance</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 45%"></div>
                                        </div>
                                        <a href="{{ route('goals.roadmap', 'running') }}" class="text-indigo-600 hover:text-indigo-900">
                                            View Roadmap →
                                        </a>
                                    </div>
                                </div>

                                <!-- English B2 Goal -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6">
                                        <h3 class="text-lg font-medium mb-2">English B2</h3>
                                        <p class="text-gray-600 mb-4">Achieve B2 level proficiency in English</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 30%"></div>
                                        </div>
                                        <a href="{{ route('goals.roadmap', 'english_b2') }}" class="text-indigo-600 hover:text-indigo-900">
                                            View Roadmap →
                                        </a>
                                    </div>
                                </div>

                                <!-- Trading Goal -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6">
                                        <h3 class="text-lg font-medium mb-2">Trading</h3>
                                        <p class="text-gray-600 mb-4">Master trading strategies and market analysis</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: 20%"></div>
                                        </div>
                                        <a href="{{ route('goals.roadmap', 'trading') }}" class="text-indigo-600 hover:text-indigo-900">
                                            View Roadmap →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div class="mt-8">
                                <h3 class="text-lg font-medium mb-4">Recent Activity</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <template x-for="goal in goals" :key="goal.id">
                                        <div class="flex items-center justify-between py-2 border-b border-gray-200 last:border-0">
                                            <div>
                                                <span class="font-medium" x-text="goal.category"></span>
                                                <span class="text-gray-600" x-text="' - ' + goal.description"></span>
                                            </div>
                                            <span class="text-sm text-gray-500" x-text="new Date(goal.last_activity_at).toLocaleDateString()"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
