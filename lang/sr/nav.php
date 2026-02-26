<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index'),
            'name' => 'Početna',
        ],
        [
            'slug' => route('product.index'),
            'name' => 'Proizvodi',
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
        [
            'slug' => route('product.create'),
            'name' => '<i class="fa-solid fa-wine-glass-empty"></i> Kreiranje proizvoda',
        ],

    ],

    'language_labels' => [
        'sr' => 'SR',
        'en' => 'EN',
    ],

];
