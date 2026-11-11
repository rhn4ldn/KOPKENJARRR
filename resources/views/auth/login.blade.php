@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

  <p class="subtitle">Selamat datang kembali — masuk untuk melanjutkan.</p>

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" autofocus>
      @error('email') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" placeholder="Password kamu" required autocomplete="current-password">
      @error('password') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <label class="checkbox-row">
      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
      <span>Ingat saya</span>
    </label>

    <button type="submit" class="btn-primary">Masuk</button>
  </form>

  <p style="margin-top: 1.6rem; font-size: 1.3rem">
    @if (Route::has('password.request'))
      <a href="{{ route('password.request') }}" style="color: var(--primary)">Lupa password?</a><br>
    @endif
    Belum punya akun? <a href="{{ route('register') }}" style="color: var(--primary)">Daftar</a>
  </p>

@endsection
