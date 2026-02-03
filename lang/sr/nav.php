<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index'),
            'name' => 'Početna',
        ],
        [
            'slug' => route('gallery'),
            'name' => 'Galerija',
        ],
        [
            'slug' => route('contact'),
            'name' => 'Kontakt',
        ],
        
    ],

    'dropdown-user' => [
        [
            'slug' => Auth::check() ? route('user.show', (Auth::user()->name)) : route('index'),
            'name' => '<i class="fa fa-user"></i>  Moj profil',
        ],
        // [
        //     'slug' => route('profile'),
        //     'name' => '<i class="fa fa-cog"></i> Podešavanje profila',
        // ],

    ],

    'languages' => [
        // Simple language switcher: always go to the index of the selected locale
        // If you want to keep the current page, see the note in the README or ask to switch to the advanced variant.
        [
            'slug' => route('index', ['locale' => 'rs']),
            'name' => 'RS',
            'separator' => true,
        ],

        [
            'slug' => route('index', ['locale' => 'en']),
            'name' => 'EN',
            'separator' => false,
        ],

    ],

];
