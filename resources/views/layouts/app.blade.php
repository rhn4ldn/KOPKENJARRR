<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Kedai Kopi Kenangan Senja — kedai kopi dengan suasana hangat dan santai. Nikmati espresso, cappuccino, latte, dan biji kopi pilihan kami.">
  <title>@yield('title', 'Kedai Kopi Kenangan Senja')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet">

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- My Style -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

  @include('partials.navbar')

  @yield('content')

  @include('partials.footer')

  @include('partials.modal')

  <!-- Feather Icons -->
  <script>
    feather.replace()
  </script>

  <!-- My Javascript -->
  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
