@extends('layouts.auth')

@section('title', 'Konfirmasi Password')

@section('content')

  <p class="subtitle">Demi keamanan, konfirmasi password kamu sebelum melanjutkan.</p>

  <form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="password" placeholder="Password kamu" required autocomplete="current-password" autofocus>
      @error('password') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn-primary">Konfirmasi</button>
  </form>

@endsection
