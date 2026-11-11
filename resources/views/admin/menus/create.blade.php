@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')

  <div class="admin-header">
    <h1>Tambah <span>Menu</span></h1>
    <a href="{{ route('admin.menus.index') }}" class="btn-secondary">&larr; Kembali</a>
  </div>

  <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @include('admin.menus._form')

    <div class="form-group full" style="flex-direction: row; gap: 1rem">
      <button type="submit" class="btn-primary">Simpan Menu</button>
      <a href="{{ route('admin.menus.index') }}" class="btn-secondary">Batal</a>
    </div>
  </form>

@endsection
