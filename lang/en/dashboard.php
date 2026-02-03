<?php

return [
    'dashboard-page' => 'Dashboard',

    'sidebar-nav' => [
        [
            'slug'=> route('dashboard-questions.index'),
            'name'=>'Questions',
        ],
        [
            'slug'=> route('dashboard-users.index'),
            'name'=>'Users',
        ],
        [
            'slug' => route('dashboard-search-stats.index'),
            'name' => 'Search Statistics',
        ],
        [
            'slug'=> route('index'),
            'name'=>'Back to site',
        ],
    ],

     'questionsPage' => [
        'title' => 'Questions',
        'filterByType' => 'Filter by type',
        'sortByDate' => 'Sort by date',
        'newestFirst' => 'Newest first',
        'oldestFirst' => 'Oldest first',
        'noQuestions' => 'No questions found.',
    ],
];
