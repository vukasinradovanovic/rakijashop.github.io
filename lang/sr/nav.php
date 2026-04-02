<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index', ['locale' => app()->getLocale()]),
            'name' => 'Početna',
        ],
        [
            'slug' => route('product.index', ['locale' => app()->getLocale()]),
            'name' => 'Proizvodi',
        ],
        [
            'slug' => route('contact', ['locale' => app()->getLocale()]),
            'name' => 'Kontakt',
        ],
        
    ],

    'dropdown-user' => [
        [
            'slug' => Auth::check()
                ? route('user.show', ['locale' => app()->getLocale(), 'user' => Auth::user()->name])
                : route('index', ['locale' => app()->getLocale()]),
            'name' => '<i class="fa fa-user"></i>  Moj profil',
        ],
        [
            'slug' => route('product.create', ['locale' => app()->getLocale()]),
            'name' => '<i class="fa-solid fa-wine-glass-empty"></i> Kreiranje proizvoda',
        ],

    ],

    'language_labels' => [
        'sr' => 'SR',
        'en' => 'EN',
    ],

];
