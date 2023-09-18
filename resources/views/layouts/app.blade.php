<!DOCTYPE html>
<html data-theme="{{ session('theme', 'light') }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body class="font-sans antialiased">
<div class="min-h-screen">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    <!-- Page Content -->

    <!--Session Alerts-->
    @include('session.alerts')

    <main>
        {{ $slot }}
    </main>

</div>
</body>
</html>
