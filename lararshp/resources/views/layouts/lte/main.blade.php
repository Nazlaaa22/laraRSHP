<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    @include('layouts.lte.head')
</head>
<!--end::Head-->

<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        {{-- Navbar --}}
        @include('layouts.lte.navbar')

        {{-- Sidebar --}}
        @include('layouts.lte.sidebar')

        <!--begin::App Main-->
        <main class="app-main">

            {{-- Tempat konten halaman --}}
            <div class="app-content">
                @yield('content')
            </div>

        </main>
        <!--end::App Main-->

        {{-- Footer --}}
        @include('layouts.lte.footer')

    </div>
    <!--end::App Wrapper-->

    <!-- ========================== -->
    <!-- ========== SCRIPT ========= -->
    <!-- ========================== -->

    <!-- OverlayScrollbars -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <!-- PopperJS (Bootstrap requirement) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    <!-- AdminLTE JS -->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>

    <!-- OverlayScrollbars Initialize -->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        crossorigin="anonymous"></script>

    @stack('scripts')

</body>
<!--end::Body-->
</html>
