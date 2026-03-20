<?php

namespace App\Http\Controllers\Question;

use App\Http\Requests\Question\StoreQuestionRequest;
use App\Models\Question\Question;
use App\Models\Question\QuestionStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($locale, StoreQuestionRequest $request): RedirectResponse
    {
        $fields = $request->validated();

        $status = QuestionStatus::query()->firstOrCreate(['name' => 'new']);

        Question::query()->create(array_merge(
            $fields,
            ['status_id' => $status->id]
        ));

        return redirect()->back()->with('success', __('messages.question_sent_success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
