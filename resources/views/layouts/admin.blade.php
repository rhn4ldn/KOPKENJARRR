<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Dashboard Admin') | Kedai Kopi Kenangan Senja</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="admin-body">

  <header class="admin-navbar">
    <a href="{{ route('home') }}" class="navbar-logo">kenangan<span>senja</span>.<span class="admin-badge">Admin</span></a>

    <nav>
      <a href="{{ route('home') }}">Lihat Situs</a>
      <form action="{{ route('admin.logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit">Keluar</button>
      </form>
    </nav>
  </header>

  <main class="admin-container">
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
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
  </main>

</body>

</html>
