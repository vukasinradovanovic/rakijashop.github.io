<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index'),
            'name' => 'Home',
        ],
        [
            'slug' => route('gallery'),
            'name' => 'Gallery',
        ],
        [
            'slug' => route('contact'),
            'name' => 'Contact',
        ],
    ],

    'dropdown-user' => [
        [
            'slug' => Auth::check() ? route('user.show', (Auth::user()->name)) : route('index'),
            'name' => '<i class="fa fa-user"></i>  My profile',
        ],
        // [
        //     'slug' => route('profile'),
        //     'name' => '<i class="fa fa-cog"></i> Profile settings',
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
