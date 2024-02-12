<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>

<body class="h-100">
    <div id="app" class="d-flex flex-column h-100"></div>
    <script>
        var userData = {{ Js::from($userData) }};
    </script>
    @vite('resources/js/app.js')
</body>

</html>
