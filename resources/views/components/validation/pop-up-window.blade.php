@props(['msg', 'type' => 'success'])
@if($msg)
    <div class="popup show {{ $type === 'error' ? 'popup--error' : 'popup--success' }}" role="status" aria-live="polite">
        <div class="popup-item" role="alert" aria-atomic="true">
            <div class="popup_head">
                <i class="fa {{ $type === 'error' ? 'fa-times-circle' : 'fa-check-circle' }} popup_icon" aria-hidden="true"></i>
                <p class="popup_title">{{ __('messages.notification') }}</p>
            </div>
            <p class="popup_message">{{ $msg }}</p>
        </div>
    </div>
@endif