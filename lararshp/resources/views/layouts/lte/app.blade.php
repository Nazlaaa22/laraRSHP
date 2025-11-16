<!doctype html>
<html lang="en">
    @include('layouts.lte.head')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">

        {{-- Navbar --}}
        @include('layouts.lte.navbar')

        {{-- Sidebar --}}
        @include('layouts.lte.sidebar')

        {{-- Main content --}}
        @include('layouts.lte.main')

        {{-- Footer --}}
        @include('layouts.lte.footer')

    </div>

    {{-- JS Scripts --}}
    @include('layouts.lte.scripts')
</body>
</html>
