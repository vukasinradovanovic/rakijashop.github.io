@props(['msg', 'type' => 'success'])
@if($msg)
    <div class="popup show {{ $type === 'error' ? 'popup--error' : 'popup--success' }}">
        <div class="popup-item">
            <p class="p-2 m-0"><i class="fa {{ $type === 'error' ? 'fa-times-circle' : 'fa-check-circle' }}  me-1"></i><b>Obaveštenje</b></p>
            <hr class="m-0 ms-2 me-2">
            <p class="p-2 m-0">{{ $msg }}</p>
        </div>
    </div>
@endif