<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index'),
            'name' => 'Home',
        ],
        [
            'slug' => route('product.index'),
            'name' => 'Products',
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
        [
            'slug' => route('product.create'),
            'name' => '<i class="fa-solid fa-wine-glass-empty"></i> Create product',
        ],
    ],

    'language_labels' => [
        'sr' => 'SR',
        'en' => 'EN',
    ],
];
