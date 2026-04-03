<?php

namespace App\Http\Controllers\Pages;

use App\Models\Product\Product;
use App\Models\Question\QuestionType;
use Illuminate\Support\Facades\Auth;

class PagesController
{
    public function index()
    {
        $featuredProducts = Product::query()
            ->featured()
            ->with(['images', 'position'])
            ->latest()
            ->take(6)
            ->get();

        return view('pages.index', [
            'featuredProducts' => $featuredProducts
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

    public function contact()
    {
        $questionTypes = QuestionType::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $userInfo = null;
        if (Auth::check()) {
            $user = Auth::user();
            $userInfo = [
                'name' => $user->name,
                'email' => $user->email,
            ];
        }

        return view('pages.contactPage', [
            'questionTypes' => $questionTypes,
            'userInfo' => $userInfo,
        ]);
    }
}
