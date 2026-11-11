@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')

  <p class="subtitle">Masukkan email kamu — kami akan kirimkan link untuk mengatur ulang password.</p>

  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" autofocus>
      @error('email') <span class="form-error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn-primary">Kirim Link Reset</button>
  </form>

@endsection
