<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ginada Florist') }}</title>
        <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/jpeg">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'cream': '#FFF7F0',
                            'surface': '#FAF4ED',
                            'olive': '#4A4A2E',
                            'taupe': '#7A7160',
                            'coral': '#E4574E',
                            'leaf': '#A2B679',
                            'sand': '#C8BBAA',
                        },
                        fontFamily: {
                            heading: ['"Playfair Display"', 'serif'],
                            body: ['"Libre Baskerville"', 'serif'],
                        }
                    }
                }
            }
        </script>

        <style>
            body { font-family: 'Libre Baskerville', serif; }
        </style>
    </head>
    <body class="bg-cream text-olive antialiased">
        <div class="min-h-screen flex">
            {{ $slot }}
        </div>
    </body>
</html>