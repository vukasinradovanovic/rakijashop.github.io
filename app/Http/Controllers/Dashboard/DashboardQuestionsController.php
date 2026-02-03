<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Questions\Question;
use App\Models\Questions\QuestionStatuses;
use App\Models\Questions\QuestionTypes;
use Illuminate\Http\Request;

class DashboardQuestionsController 
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $questions = Question::query()
            ->with(['status','type']); // eager-load

        $types = QuestionTypes::all();
        $statuses = QuestionStatuses::all();

        if ($request->filled('questionType')) {
            $questions->where('type_id', $request->questionType);
        }

        // mapiraj 'new' => desc, 'old' => asc
        $sort = $request->get('questionSort', 'new');
        $direction = $sort === 'old' ? 'asc' : 'desc';
        $questions->orderBy('created_at', $direction);

        $questions = $questions->paginate(10);

        if ($request->ajax()) {
            return view('dashboard.dashboardQuestions.partials.questionList', compact('questions'))->render();
        }

        return view('dashboard.dashboardQuestions.dashboardQuestionsPage', compact('questions', 'types'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $dashboard_question)
    {
        $question = $dashboard_question->load(['type','status']);
        return view('dashboard.dashboardQuestions.dashboardQuestionDetailsPage', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Mark a question as read.
     */
    public function markAsRead(Question $question)
    {
        if ((int)($question->status_id ?? 0) !== 4) {
            $question->update(['status_id' => 4]);
        }

        return response()->json(['success' => true, 'message' => 'Question marked as read.']);
    }
}
