<div class="content-wrapper">
    @include('flash::message')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div id="toastsContainerTopRight" class="toasts-top-right fixed alert">
                <div class="toast bg-danger }} fade show" role="alert" aria-live="assertive"
                     aria-atomic="true">
                    <div class="toast-header">
                        <div class="mr-auto">
                            <i class="icon fas fa-exclamation-circle"></i>
                            {{ $error }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <span aria-hidden="true"> ×</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @yield('content')
</div>
