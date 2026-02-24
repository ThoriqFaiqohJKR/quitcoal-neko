<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'QuitCoal')</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="text-gray-800 min-h-screen flex flex-col">

    @include('components.cms.navbar')

    <main class="flex-1 container mx-auto px-4 py-20">
        @yield('content')
    </main>

    @include('components.cms.footer')

    @livewireScripts
    @stack('scripts')



</body>

</html>