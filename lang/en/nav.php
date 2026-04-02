<?php

use Illuminate\Support\Facades\Auth;

return [
    'nav' => [
        [
            'slug' => route('index', ['locale' => app()->getLocale()]),
            'name' => 'Home',
        ],
        [
            'slug' => route('product.index', ['locale' => app()->getLocale()]),
            'name' => 'Products',
        ],
        [
            'slug' => route('contact', ['locale' => app()->getLocale()]),
            'name' => 'Contact',
        ],
    ],

    'dropdown-user' => [
        [
            'slug' => Auth::check()
                ? route('user.show', [
                    'locale' => app()->getLocale(),
                    'user' => filled(Auth::user()->username ?? null)
                        ? Auth::user()->username
                        : (string) Auth::id(),
                ])
                : route('index', ['locale' => app()->getLocale()]),
            'name' => '<i class="fa fa-user"></i>  My profile',
        ],
        [
            'slug' => Auth::check()
                ? route('user.edit', [
                    'locale' => app()->getLocale(),
                    'user' => filled(Auth::user()->username ?? null)
                        ? Auth::user()->username
                        : (string) Auth::id(),
                ])
                : route('index', ['locale' => app()->getLocale()]),
            'name' => '<i class="fa fa-user"></i>  Edit profile',
        ],
        [
            'slug' => route('product.create', ['locale' => app()->getLocale()]),
            'name' => '<i class="fa-solid fa-wine-glass-empty"></i> Create product',
        ],
    ],

    'language_labels' => [
        'sr' => 'SR',
        'en' => 'EN',
    ],
];
