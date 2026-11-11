@extends('layouts.auth')

@section('title', 'Atur Ulang Password')

@section('content')

  <p class="subtitle">Buat password baru untuk akun kamu.</p>

  <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
      @error('email') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="password">Password Baru</label>
      <input id="password" type="password" name="password" placeholder="Minimal 8 karakter, huruf besar & angka" required autocomplete="new-password">
      @error('password') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
      <label for="password-confirm">Konfirmasi Password Baru</label>
      <input id="password-confirm" type="password" name="password_confirmation" placeholder="Ulangi password baru" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn-primary">Simpan Password Baru</button>
  </form>

@endsection
