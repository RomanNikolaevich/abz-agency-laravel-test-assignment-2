<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico"/>
    <title>Laravel + Vue App for abz.agency</title>
    @vite('resources/js/app.js')
</head>
<body class="h-full">
<div class="bg-white px-4 py-12 sm:px-6 lg:px-8">
    <div id="app" class="mx-auto max-w-4xl"></div>
</div>
</body>
</html>
