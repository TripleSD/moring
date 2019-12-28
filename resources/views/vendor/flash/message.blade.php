@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div id="toastsContainerTopRight" class="toasts-top-right fixed alert">
            <div class="toast bg-{{ $message['level'] }} fade show" role="alert" aria-live="assertive"
                 aria-atomic="true">
                <div class="toast-header">
                    <div class="mr-auto">
                        @if($message['level'] === 'success')
                            <i class="icon fas fa-check-circle"></i>
                        @elseif($message['level'] === 'danger')
                            <i class="icon fas fa-exclamation-circle"></i>
                        @elseif($message['level'] === 'warning')
                            <i class="icon fas fa-exclamation-triangle"></i>
                        @endif
                        {{ $message['message'] }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <span aria-hidden="true"> ×</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
