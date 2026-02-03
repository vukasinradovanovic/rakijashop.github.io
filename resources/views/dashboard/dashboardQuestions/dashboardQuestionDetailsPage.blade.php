@extends('dashboard.layout.layout')

{{-- Variables section --}}
@php
$typeName = $question->type?->name;
$senderName = $question->name ?? $question->email ?? 'Unknown';
$senderEmail = $question->email ?? 'Unknown';
$senderDescription = $question->description ?? '';
$statusName = $question->status?->name ?? 'No Status';
$time = optional($question->created_at)->diffForHumans() ?? '';

@endphp

@section('main')
<div class="dashboard_questions container-fluid m-auto p-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('dashboard-questions.index') }}" class="btn btnWhite">
      <i class="fa fa-chevron-left me-1"></i> Nazad na listu
    </a>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title mb-3">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-light text-dark border">{{ $typeName }}</span>
          <span class="badge bg-info text-dark">{{ $statusName }}</span>
          <span class="text-muted small">{{ $time }}</span>
        </div>
      </h5>

      <div class="mb-3 text-muted small">
        <div>
          <i class="fa fa-user me-1"></i>
          <strong>{{ $senderName }}</strong>
          @if($senderEmail)
          <span class="ms-2">• {{ $senderEmail }}</span>
          @endif
        </div>
      </div>

      <div class="border-top pt-3">
        {!! nl2br(e($senderDescription)) !!}
      </div>
    </div>
  </div>

  <div class="d-flex gap-2">
    <a href="{{ route('dashboard-questions.index') }}" class="btn btnWhite">
      <i class="fa fa-inbox me-1"></i> Inbox
    </a>
  </div>
</div>
@endsection