<?php

namespace App\Http\Controllers\User;

use App\Models\User\Reviews;
use App\Models\User\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewsController
{
    public function show ($locale, $username, Request $request) {
        $user = User::findByUsername($username)->firstOrFail();
        $query = $user->reviewsReceived();
        // Sortiranje na osnovu request parametara
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case '1':
                    $query->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $query->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $query->orderBy('rating', 'desc');
                    break;
                case '4':
                    $query->orderBy('rating', 'asc');
                    break;
            }
        }

        $reviews = $query->paginate(12);
        $backUrl = $request->query('from');
        if (!$backUrl || parse_url($backUrl, PHP_URL_HOST) !== $request->getHost()) {
            $backUrl = route('user.show', [
                'locale' => $locale,
                'user' => $user->getUsername(),
            ]);
        }

        return view('user.reviewUserPage', compact('reviews', 'user', 'backUrl'));
    }
    
    public function store( Request $request ) {
        $reviewerId = Auth::id();

        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id', Rule::notIn([$reviewerId])],
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:200',

        ],[
            'user_id.exists' => __('reviews.user_not_found'),
            'user_id.not_in' => __('reviews.self_review'),
        ]);
    try{
        Reviews::create([
            'reviewed_user_id' => $validated['user_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
            'reviewer_id' => $reviewerId,
        ]);
        return redirect()->back()->with('success', __('reviews.success'));
    } 
    catch (QueryException $e) {
        if ($e->getCode() == '23000') {
            return redirect()->back()->withErrors([
                'failed' => __('reviews.duplicate')
            ]);
        }
        throw $e;
    }
        
    }
}
