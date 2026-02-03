@extends('dashboard.layout.layout')

@section('main')
<h2 class="text-center">Pitanja</h2>
<hr class="border border-gray border-2">

<div class="dashboard_questions container-fluid m-auto p-3">

  <!-- Toolbar: search / type / sort -->
  <form id="filterForm" method="GET" action="{{ url()->current() }}" class="dashboard_questionsFilter mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-12 col-md-6">
        <div class="input-group">
          <span class="input-group-text"><i class="fa fa-search"></i></span>
          <input id="questionSearch" name="q" type="search" class="form-control"
                 placeholder="Search messages" value="{{ request('q') }}">
          <button id="questionSearchBtn" class="btn btnWhite" type="submit">
            {{ __('Search') }}
          </button>
        </div>
      </div>

      <!-- IDs must match JS: #questionType and #questionSort.
           Names are aligned with JS payload keys (questionType, questionSort). -->
      <div class="col-6 col-md-3">
        <select id="questionType" class="form-select" name="questionType">
          <option value="">{{ __('Svi tipovi') }}</option>
          @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ (string)request('questionType') === (string)$type->id ? 'selected' : '' }}>
              {{ $type->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-6 col-md-3">
        <select id="questionSort" class="form-select" name="questionSort">
          <option value="new" {{ request('questionSort','new') === 'new' ? 'selected' : '' }}>
            {{ __('sidebar.new') }}
          </option>
          <option value="old" {{ request('questionSort') === 'old' ? 'selected' : '' }}>
            {{ __('sidebar.old') }}
          </option>
        </select>
      </div>
    </div>
  </form>

  <hr class="border border-gray border-2">

  <!-- Gmail-like summary list (AJAX will replace this inner HTML) -->
  <div class="dashboard_questionsList list-group list-group-flush">
    @include('dashboard.dashboardQuestions.partials.questionList', ['questions' => $questions])
  </div>
</div>
@endsection