<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div id="app">
            <app :name="'{{ env('APP_NAME') }}'"></app>
        </div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>
