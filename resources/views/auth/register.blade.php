@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

  <p class="subtitle">Buat akun untuk pengalaman yang lebih menyenangkan di Kenangan Senja.</p>

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
      <label for="name">Nama</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required autocomplete="name" autofocus>
      @error('name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email">
      @error('email') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" placeholder="Minimal 8 karakter, huruf besar & angka" required autocomplete="new-password">
      @error('password') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="password-confirm">Konfirmasi Password</label>
      <input id="password-confirm" type="password" name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn-primary">Daftar</button>
  </form>

  <p style="margin-top: 1.6rem; font-size: 1.3rem">
    Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--primary)">Masuk</a>
  </p>

@endsection
