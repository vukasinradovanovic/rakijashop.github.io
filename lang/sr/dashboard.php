<?php

return [
    'dashboard-page' => 'Dashboard',

    'sidebar-nav' => [
        [
            'slug'=> route('dashboard-questions.index'),
            'name'=>'Pitanja',
        ],
        [
            'slug'=> route('dashboard-users.index'),
            'name'=>'Korisnici',
        ],
        [
            'slug' => route('dashboard-search-stats.index'),
            'name' => 'Statistika pretrage',
        ],
        [
            'slug'=> route('index'),
            'name'=>'Nazad na sajt',
        ],
    ],

     'questionsPage' => [
        'title' => 'Pitanja',
        'filterByType' => 'Filtriraj po tipu',
        'sortByDate' => 'Sortiraj po datumu',
        'newestFirst' => 'Najnovije prvo',
        'oldestFirst' => 'Najstariji prvo',
        'noQuestions' => 'Nema pronađenih pitanja.',
    ],
];
