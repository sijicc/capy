<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ collect($title)->pluck('name')->implode(' | ') }} | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

<main class="flex flex-col items-center justify-center min-h-screen bg-gray-200">

    {{ $slot }}

</main>


</body>
