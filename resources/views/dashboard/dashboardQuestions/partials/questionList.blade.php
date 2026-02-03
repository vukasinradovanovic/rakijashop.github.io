@forelse (($questions ?? collect()) as $question)
{{-- Variables section --}}
@php
$statusId = $question->status?->id;
$statusName = $question->status?->name ?? 'No Status';
$sender = $question->name ?? $question->email ?? 'Unknown';
$snippet = \Illuminate\Support\Str::limit(strip_tags($question->description ?? ''), 120);
$time = optional($question->created_at)->diffForHumans() ?? '';
$typeName = $question->type?->name;
$isNew = (int)($statusId ?? 0) === 1; // 1 = new message
@endphp

<div class="list-group-item py-2 px-0">
    <div class="row g-0 align-items-center dashboard_questionsItem {{ $isNew ? 'is-new' : 'is-old' }}"
        data-id="{{ $question->id }}" data-mark-url="{{ route('dashboard-questions.mark-as-read', $question) }}">
        <div class="col-auto px-3">
            <span class="badge bg-light text-dark border me-2">{{ $statusName }}</span>
        </div>

        <div class="col-12 col-md-2 text-truncate px-2 {{ $isNew ? 'fw-bold' : '' }}">
            {{ $sender }}
        </div>

        <div class="col-12 col-md px-2 text-truncate">
            <a href="{{ route('dashboard-questions.show', $question) }}" class="stretched-link text-decoration-none">
                @if($typeName)
                <span class="badge bg-light text-dark border ms-2">{{ $typeName }}</span>
                @endif
                <span class="text-muted ms-2 d-none d-md-inline">— {{ $snippet }}</span>
            </a>
        </div>

        <div class="col-auto px-3 text-nowrap text-muted small">
            {{ $time }}
        </div>
    </div>
</div>
@empty
<div class="text-center text-bg-light text-muted py-5 w-100">
    {{ __('dashboard.questionsPage.noQuestions') }}
</div>
@endforelse