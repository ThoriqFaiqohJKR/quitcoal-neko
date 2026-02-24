<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>



    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

    @livewireStyles
</head>

<body class="min-h-screen flex flex-col">

    @include('components.user.navbar')

    <main class="flex-1 container mx-auto py-32">
        @yield('content')
    </main>

    @include('components.user.footer')

    @livewireScripts
    @stack('scripts')



</body>

</html>