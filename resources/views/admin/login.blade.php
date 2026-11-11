<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title>Login Admin | Kedai Kopi Kenangan Senja</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700;1,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

  <div class="login-wrap">
    <div class="login-card">
      <h1>kenangan<span>senja</span>.</h1>
      <p class="subtitle">Masuk ke Dashboard Admin Kedai Kopi Kenangan Senja</p>

      @if ($errors->any())
        <div class="alert alert-error">
          <ul style="margin-left: 2rem">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@kopkenjar.test" required autofocus>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <label class="checkbox-row">
          <input type="checkbox" name="remember" value="1">
          <span>Ingat saya</span>
        </label>
        <button type="submit" class="btn-primary">Masuk</button>
      </form>

      <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke beranda</a>
    </div>
  </div>

</body>

</html>
