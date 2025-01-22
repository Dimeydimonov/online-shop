<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web Shop</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>
<body>

@include('components.header')

<!-- Main Content -->
<main class="main-content">
    @yield('content')
</main>

<!-- Footer -->
@include('components.footer')

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
