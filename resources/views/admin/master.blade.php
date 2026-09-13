@include('admin.header')
    @if(session('success'))
        <div class="alert alert-success shadow admin-toast-alert position-fixed top-0 end-0 me-2 z-3" role="alert" style="z-index: 9999; margin-top: 60px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow admin-toast-alert position-fixed top-0 end-0 me-2 z-3" role="alert" style="z-index: 9999; margin-top: 60px;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning shadow admin-toast-alert position-fixed top-0 end-0 me-2 z-3" role="alert" style="z-index: 9999; margin-top: 60px;">
            {{ session('warning') }}
        </div>
    @endif

<div class="app-content" style="padding: 10px 20px;">
    @yield('content')
</div>

@include('admin.footer')