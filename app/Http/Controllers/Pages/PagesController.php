<?php

namespace App\Http\Controllers\Pages;

use App\Models\Product\Product;
use App\Models\Question\QuestionType;

class PagesController
{
    public function index()
    {
        $featuredProducts = Product::query()
            ->where('status_id', 1)
            ->latest()
            ->take(6)
            ->get();

        return view('pages.index', [
            'featuredProducts' => $featuredProducts,
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function gallery()
    {
        return view('pages.galleryPage');
    }

    public function contact()
    {
        $questionTypes = QuestionType::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('pages.contactPage', [
            'questionTypes' => $questionTypes,
        ]);
    }
}
