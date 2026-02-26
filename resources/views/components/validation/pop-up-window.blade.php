@props(['msg', 'type' => 'success'])
@if($msg)
    <div class="popup show {{ $type === 'error' ? 'popup--error' : 'popup--success' }}" role="status" aria-live="polite">
        <div class="popup-item" role="alert" aria-atomic="true">
            <div class="popup__head">
                <i class="fa {{ $type === 'error' ? 'fa-times-circle' : 'fa-check-circle' }} popup__icon" aria-hidden="true"></i>
                <p class="popup__title">{{ __('messages.notification') }}</p>
            </div>
            <p class="popup__message">{{ $msg }}</p>
        </div>
    </div>
@endif