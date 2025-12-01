<!doctype html>
<html lang="en">
<head>
    @include('layouts.lte.head')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    {{-- NAVBAR --}}
    @include('layouts.lte.navbar')

    {{-- SIDEBAR --}}
    @include('layouts.lte.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="app-main">
        <div class="app-content-header">
            {{-- Breadcrumb otomatis jika butuh --}}
            @yield('header')
        </div>

        <div class="app-content">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    @include('layouts.lte.footer')

</div>


{{-- JS LIBRARIES --}}
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>

{{-- ADMINLTE --}}
<script src="{{ asset('assets/js/adminlte.js') }}"></script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';

    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper);
        }
    });
</script>

@stack('scripts')

</body>
</html>
