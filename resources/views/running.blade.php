<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roadmap for Mastering Running') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (Auth::check())
                        @php
                            $runningGoal = Auth::user()->goals()
                                ->where('category', 'running')
                                ->orderBy('updated_at', 'desc')
                                ->first();
                            $progress = $runningGoal ? $runningGoal->progress : 0;
                        @endphp

                        @if ($runningGoal)
                            <section id="course" class="mb-8">
                                <h2 class="text-xl font-semibold text-blue-600 mb-4 border-b-2 border-blue-600 pb-2">
                                    Course - Introduction to Running
                                </h2>
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <p class="mb-4">Running is an excellent way to improve your cardiovascular health, endurance, and overall well-being. To progress effectively, follow a structured plan. This course covers the basics, from warm-up to recovery, and emphasizes the importance of nutrition and rest.</p>
                                    <img class="w-full max-w-xs rounded-lg shadow-md mb-4" alt="Runner in forest" src="https://images.pexels.com/photos/2261477/pexels-photo-2261477.jpeg?auto=compress&cs=tinysrgb&h=350" />
                                    <h3 class="text-lg font-medium text-gray-700 mb-2">Basics:</h3>
                                    <ul class="list-disc pl-5 mb-4 text-gray-600">
                                        <li>Warm-up: 5-10 minutes of light exercises (walking, dynamic stretches)</li>
                                        <li>Running technique: Straight posture, smooth strides, rhythmic breathing</li>
                                        <li>Progressive progression: Alternate walking and running at first</li>
                                        <li>Recovery: Stretching and hydration after each session</li>
                                        <li>Equipment: Shoes suited to your stride type</li>
                                    </ul>
                                    <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                                        <div class="h-4 rounded-full bg-blue-600 text-xs text-white flex items-center justify-center transition-all duration-300" style="width: {{ $progress }}%" title="{{ $progress }}%">
                                            {{ $progress }}%
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <section id="schema" class="mb-8">
                                <h2 class="text-xl font-semibold text-blue-600 mb-4 border-b-2 border-blue-600 pb-2">
                                    Running Roadmap Schema
                                </h2>
                                <div class="text-center mb-6">
                                    <img class="w-3/4 max-w-md rounded-lg shadow-md" alt="Running progression schema" src="https://images.pexels.com/photos/1552249/pexels-photo-1552249.jpeg?auto=compress&cs=tinysrgb&h=600" />
                                </div>
                                <div class="flex flex-wrap justify-around gap-6" aria-label="Roadmap steps for mastering running">
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">1</div>
                                        <div class="step-title font-semibold text-lg mb-2">Initial Evaluation</div>
                                        <div class="step-desc text-gray-600">Assess your current fitness, goals, and motivation.</div>
                                    </article>
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">2</div>
                                        <div class="step-title font-semibold text-lg mb-2">Warm-up</div>
                                        <div class="step-desc text-gray-600">Start each session with dynamic stretches and a brisk walk.</div>
                                    </article>
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">3</div>
                                        <div class="step-title font-semibold text-lg mb-2">Progressive Training</div>
                                        <div class="step-desc text-gray-600">Alternate walking and running, increasing running duration.</div>
                                    </article>
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">4</div>
                                        <div class="step-title font-semibold text-lg mb-2">Consolidation</div>
                                        <div class="step-desc text-gray-600">Increase endurance and distance weekly.</div>
                                    </article>
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">5</div>
                                        <div class="step-title font-semibold text-lg mb-2">Recovery & Rest</div>
                                        <div class="step-desc text-gray-600">Include full rest days for muscle recovery.</div>
                                    </article>
                                    <article class="step flex-1 min-w-[140px] bg-white rounded-lg p-5 shadow-md hover:shadow-lg transition-transform duration-300 cursor-pointer" tabindex="0">
                                        <div class="step-number text-2xl font-bold text-blue-600 mb-2">6</div>
                                        <div class="step-title font-semibold text-lg mb-2">Evaluation & Adjustments</div>
                                        <div class="step-desc text-gray-600">Review progress and adjust the plan as needed.</div>
                                    </article>
                                </div>
                            </section>

                            <section id="exercises" class="mb-8">
                                <h2 class="text-xl font-semibold text-blue-600 mb-4 border-b-2 border-blue-600 pb-2">
                                    Exercises to Apply
                                </h2>
                                <div class="bg-white p-6 rounded-lg shadow-md">
                                    <div class="exercise-item mb-4">
                                        <strong class="text-gray-800">1. Fast Walk / Endurance Run: </strong>Alternate 2 minutes of fast walking with 1 minute of running, repeat 6 times.
                                    </div>
                                    <div class="exercise-item mb-4">
                                        <strong class="text-gray-800">2. Bounding Strides: </strong>Run with exaggerated push-off to improve leg power (3x30m).
                                    </div>
                                    <div class="exercise-item mb-4">
                                        <strong class="text-gray-800">3. Uphill Sprints: </strong>Sprint on a gentle slope to strengthen thighs (5x20 seconds).
                                    </div>
                                    <div class="exercise-item mb-4">
                                        <strong class="text-gray-800">4. Dynamic Plank: </strong>Enhance core stability with 3 sets of side planks (30 seconds per side).
                                    </div>
                                    <div class="exercise-item mb-4">
                                        <strong class="text-gray-800">5. Post-Session Stretches: </strong>Stretch quadriceps, hamstrings, calves, and back to prevent injuries.
                                    </div>
                                    <img class="w-full max-w-xs rounded-lg shadow-md" alt="Running exercise" src="https://images.pexels.com/photos/2402776/pexels-photo-2402776.jpeg?auto=compress&cs=tinysrgb&h=350" />
                                </div>
                            </section>

                            <section id="test" class="mb-8">
                                <h2 class="text-xl font-semibold text-blue-600 mb-4 border-b-2 border-blue-600 pb-2">
                                    Knowledge Test
                                </h2>
                                <div id="quiz" class="bg-white p-6 rounded-lg shadow-md" aria-label="Quiz on mastering running">
                                    <div class="test-item mb-6">
                                        <p class="mb-2"><strong>1. What is the main purpose of a warm-up before running?</strong></p>
                                        <label class="block mb-1"><input type="radio" name="q1" value="a" /> Increase muscle strength</label>
                                        <label class="block mb-1"><input type="radio" name="q1" value="b" /> Gently prepare the body</label>
                                        <label class="block mb-1"><input type="radio" name="q1" value="c" /> Improve endurance</label>
                                        <div class="result mt-2 font-medium" id="result1"></div>
                                    </div>

                                    <div class="test-item mb-6">
                                        <p class="mb-2"><strong>2. How many full rest days are recommended per week?</strong></p>
                                        <label class="block mb-1"><input type="radio" name="q2" value="a" /> 0 days, run every day</label>
                                        <label class="block mb-1"><input type="radio" name="q2" value="b" /> 1-2 days</label>
                                        <label class="block mb-1"><input type="radio" name="q2" value="c" /> 3-4 days</label>
                                        <div class="result mt-2 font-medium" id="result2"></div>
                                    </div>

                                    <button id="submitQuiz" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200" aria-label="Submit quiz">
                                        Submit
                                    </button>
                                    <div id="finalResult" aria-live="polite" class="mt-4 font-semibold"></div>
                                </div>
                            </section>

                            <form method="POST" action="{{ route('goals.update', 'running') }}" class="mt-6">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-200">
                                    Mark Complete
                                </button>
                            </form>
                        @else
                            <p class="text-center text-gray-600">No running goal found for your account. <a href="{{ route('goals.create') }}" class="text-blue-600 underline">Create one now</a>.</p>
                        @endif
                    @else
                        <p class="text-center text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 underline">log in</a> to view your running roadmap.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const correctAnswers = { q1: "b", q2: "b" };
            const submitBtn = document.getElementById('submitQuiz');
            const finalResultDiv = document.getElementById('finalResult');

            function showResult(questionId, correct) {
                const el = document.getElementById('result' + questionId.slice(1));
                if (correct) {
                    el.textContent = "✅ Correct!";
                    el.style.color = "green";
                } else {
                    el.textContent = "❌ Incorrect.";
                    el.style.color = "red";
                }
            }

            submitBtn.addEventListener('click', () => {
                finalResultDiv.textContent = "";
                let score = 0;
                let total = Object.keys(correctAnswers).length;

                for (const [qId, correct] of Object.entries(correctAnswers)) {
                    let selected = document.querySelector(`input[name="${qId}"]:checked`);
                    if (!selected) {
                        showResult(qId, false);
                    } else {
                        let isCorrect = selected.value === correct;
                        if (isCorrect) score++;
                        showResult(qId, isCorrect);
                    }
                }

                finalResultDiv.textContent = `Your Score: ${score} / ${total} (${Math.round(score / total * 100)}%)`;
                if (score === total) {
                    finalResultDiv.style.color = "green";
                } else {
                    finalResultDiv.style.color = "orange";
                }
            });
        })();
    </script>
</x-app-layout>