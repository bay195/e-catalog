<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        /* Global Styles */
        body {
            background-color: #f4f4f9; /* Light background */
            color: #333; /* Text color for light mode */
            font-family: 'Figtree', sans-serif;
        }

        .bg-gray-100 {
            background-color: #f4f4f9;
        }

        /* Dark Mode Styles */
        .dark .bg-gray-100 {
            background-color: #1f2937; /* Dark background */
        }

        .dark body {
            background-color: #1f2937; /* Dark body background */
            color: #e5e7eb; /* Text color for dark mode */
        }

        /* Container styles */
        .min-h-screen {
            min-height: 100vh;
        }

        /* Header Styles */
        header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .dark header {
            background-color: #374151; /* Dark header */
            border-bottom: 1px solid #6b7280;
        }

        /* Utility classes */
        .bg-white {
            background-color: #ffffff;
        }

        .dark .bg-white {
            background-color: #1f2937; /* Dark background for card */
        }

        .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dark .shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: #1f2937; /* Header color */
        }

        .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
            color: #e5e7eb; /* Header color in dark mode */
        }

        /* Link colors */
        a {
            color: #007bff; /* Default link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .dark a {
            color: #60a5fa; /* Link color in dark mode */
        }
    </style>

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
