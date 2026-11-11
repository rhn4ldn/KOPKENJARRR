<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Akun') | Kedai Kopi Kenangan Senja</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

  <div class="login-wrap">
    <div class="login-card">
      <h1><a href="{{ route('home') }}" style="color: inherit">kenangan<span>senja</span>.</a></h1>

      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-error">
          <ul style="margin-left: 2rem">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')

      <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke katalog</a>
    </div>
  </div>

</body>

</html>
