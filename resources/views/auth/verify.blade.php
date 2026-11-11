@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')

  <p class="subtitle">Sebelum melanjutkan, silakan cek email kamu untuk link verifikasi.</p>

  @if (session('resent'))
    <div class="alert alert-success">Link verifikasi baru sudah dikirim ke email kamu.</div>
  @endif

  <p style="font-size: 1.3rem; color: #aaa">
    Belum menerima email?
    <form method="POST" action="{{ route('verification.resend') }}" style="display: inline">
      @csrf
      <button type="submit" style="background: none; border: none; color: var(--primary); cursor: pointer; font-size: 1.3rem; font-family: 'Poppins', sans-serif; padding: 0; text-decoration: underline">Kirim ulang link verifikasi</button>.
    </form>
  </p>

@endsection
