<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pizzas') }}</title>
    <!-- Styles
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>
        @page { size: 88mm 90mm }
        @media print { body.receipt { width: 88mm } } /* fix for Chrome */
        body   { font-family: serif;
        font-size: 12pt; line-height: 5mm  }
    </style>
</head>
<body class="receipt">
    <section id="app" class="sheet padding-10mm">
        <main class="h-screen">
            @yield('recipient')
        </main>
    </div>
</body>
</html>
