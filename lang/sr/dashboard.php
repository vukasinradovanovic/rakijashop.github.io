<?php

return [
    'dashboard-page' => 'Dashboard',
    'unknown' => 'Nepoznato',
    'no_status' => 'Bez statusa',

    'sidebar-nav' => [
        [
            'slug'=> route('dashboard-users.index'),
            'name'=>'Korisnici',
        ],
        [
            'slug'=> route('index', ['locale' => app()->getLocale()]),
            'name'=>'Nazad na sajt',
        ],
    ],

    'index' => [
        'title' => 'Dashboard',
        'logged_in' => 'Prijavljen:',
        'site_info' => 'Informacije sajta',
        'info_name' => 'Ime informacije',
        'count' => 'Broj',
        'total_users' => 'Ukupan broj korisnika',
        'active_users' => 'Aktivni korisnici',
        'role' => 'Rola',
        'full_name' => 'Ime i prezime',
    ],

    'users' => [
        'title' => 'Korisnici',
        'search_placeholder' => 'Pretražite korisnička imena...',
        'assigned_username' => 'Dodeljeno korisničko ime',
        'edited_username' => 'Promenjeno korisničko ime',
        'full_name' => 'Ime i prezime',
        'role' => 'Rola',
        'status' => 'Status',
        'reset' => 'Reset',
        'change' => 'Promeni',
        'no_data' => 'Nema informacija za prikaz',
        'update_error' => 'Greška prilikom ažuriranja korisnika',
        'user_not_found' => 'Korisnik nije pronađen.',
        'update_success' => 'Korisnik je uspešno ažuriran.',
    ],

    'search' => [
        'title' => 'Statistika pretrage',
        'sort' => 'Sortiraj:',
        'most_searches' => 'Najviše pretraga',
        'least_searches' => 'Najmanje pretraga',
        'input_title' => 'Pretraga preko unosa teksta',
        'search_name' => 'Naziv pretrage',
        'search_type' => 'Tip pretrage',
        'search_count' => 'Broj pretraga',
        'load_error' => 'Greška pri učitavanju podataka.',
    ],

    'questionsPage' => [
        'title' => 'Pitanja',
        'filterByType' => 'Filtriraj po tipu',
        'sortByDate' => 'Sortiraj po datumu',
        'newestFirst' => 'Najnovije prvo',
        'oldestFirst' => 'Najstariji prvo',
        'noQuestions' => 'Nema pronađenih pitanja.',
        'search_messages' => 'Pretraži poruke',
        'search' => 'Pretraži',
        'all_types' => 'Svi tipovi',
    ],

    'questionDetails' => [
        'back_to_list' => 'Nazad na listu',
        'inbox' => 'Inbox',
        'mark_read_success' => 'Pitanje je označeno kao pročitano.',
    ],
];
