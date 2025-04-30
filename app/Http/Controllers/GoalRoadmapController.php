<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;

class GoalRoadmapController extends Controller
{
    public function show($category)
    {
        // Check if the goal exists in the database
        $goal = Goal::where('category', $category)
            ->where('user_id', auth()->id())
            ->first();

        if (!$goal) {
            abort(404, 'Goal not found');
        }

        $roadmaps = [
            'running' => [
                'title' => 'Running Goal Roadmap',
                'steps' => [
                    ['title' => 'Week 1-2: Foundation', 'description' => 'Start with 20-30 minute runs, 3 times per week. Focus on proper form and breathing.'],
                    ['title' => 'Week 3-4: Build Endurance', 'description' => 'Increase running time to 30-40 minutes. Add one long run per week.'],
                    ['title' => 'Week 5-6: Speed Work', 'description' => 'Introduce interval training. Run 4 times per week.'],
                    ['title' => 'Week 7-8: Distance', 'description' => 'Focus on increasing distance. Aim for 5-7km runs.'],
                    ['title' => 'Week 9-10: Performance', 'description' => 'Work on pace and endurance. Include hill training.'],
                    ['title' => 'Week 11-12: Race Prep', 'description' => 'Taper training. Focus on recovery and race strategy.'],
                ],
                'resources' => [
                    ['title' => 'Running Form Guide', 'url' => '#'],
                    ['title' => 'Training Schedule', 'url' => '#'],
                    ['title' => 'Nutrition Tips', 'url' => '#'],
                ]
            ],
            'english_b2' => [
                'title' => 'English B2 Level Roadmap',
                'steps' => [
                    ['title' => 'Month 1: Grammar Foundation', 'description' => 'Review and practice essential grammar structures.'],
                    ['title' => 'Month 2: Vocabulary Building', 'description' => 'Expand vocabulary to 3000-4000 words.'],
                    ['title' => 'Month 3: Speaking Practice', 'description' => 'Focus on fluency and pronunciation.'],
                    ['title' => 'Month 4: Listening Skills', 'description' => 'Practice with various accents and speeds.'],
                    ['title' => 'Month 5: Writing Skills', 'description' => 'Work on essays and formal writing.'],
                    ['title' => 'Month 6: Exam Preparation', 'description' => 'Practice tests and time management.'],
                ],
                'resources' => [
                    ['title' => 'Grammar Exercises', 'url' => '#'],
                    ['title' => 'Vocabulary Lists', 'url' => '#'],
                    ['title' => 'Practice Tests', 'url' => '#'],
                ]
            ],
            'trading' => [
                'title' => 'Trading Mastery Roadmap',
                'steps' => [
                    ['title' => 'Month 1: Market Basics', 'description' => 'Learn about different markets and instruments.'],
                    ['title' => 'Month 2: Technical Analysis', 'description' => 'Study charts, patterns, and indicators.'],
                    ['title' => 'Month 3: Risk Management', 'description' => 'Learn position sizing and risk control.'],
                    ['title' => 'Month 4: Trading Strategies', 'description' => 'Develop and test trading strategies.'],
                    ['title' => 'Month 5: Psychology', 'description' => 'Work on trading psychology and discipline.'],
                    ['title' => 'Month 6: Live Trading', 'description' => 'Start with small positions and scale up.'],
                ],
                'resources' => [
                    ['title' => 'Market Analysis Tools', 'url' => '#'],
                    ['title' => 'Strategy Templates', 'url' => '#'],
                    ['title' => 'Risk Calculator', 'url' => '#'],
                ]
            ]
        ];

        if (!isset($roadmaps[$category])) {
            abort(404, 'Roadmap not found for this category');
        }

        return view('goals.roadmap', [
            'roadmap' => $roadmaps[$category],
            'category' => $category,
            'goal' => $goal
        ]);
    }

    public function englishB2()
    {
        $roadmap = [
            'title' => 'English B2 Level Roadmap',
            'steps' => [
                [
                    'title' => 'Grammar Fundamentals',
                    'description' => 'Master essential grammar rules and structures'
                ],
                [
                    'title' => 'Vocabulary Building',
                    'description' => 'Expand your vocabulary to 4000+ words'
                ],
                [
                    'title' => 'Listening Comprehension',
                    'description' => 'Practice understanding native speakers at normal speed'
                ],
                [
                    'title' => 'Speaking Practice',
                    'description' => 'Develop fluency and confidence in speaking'
                ],
                [
                    'title' => 'Reading Comprehension',
                    'description' => 'Read and understand complex texts and articles'
                ],
                [
                    'title' => 'Writing Skills',
                    'description' => 'Write clear, detailed texts on various subjects'
                ]
            ],
            'resources' => [
                [
                    'title' => 'Grammar Guide',
                    'url' => 'https://www.englishgrammar.org/'
                ],
                [
                    'title' => 'Vocabulary Lists',
                    'url' => 'https://www.vocabulary.com/lists/'
                ],
                [
                    'title' => 'Listening Practice',
                    'url' => 'https://www.bbc.co.uk/learningenglish/'
                ]
            ]
        ];

        return view('goals.roadmap', [
            'category' => 'english_b2',
            'roadmap' => $roadmap
        ]);
    }
} 