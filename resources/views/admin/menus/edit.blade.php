@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')

  <div class="admin-header">
    <h1>Edit <span>{{ $menu->name }}</span></h1>
    <a href="{{ route('admin.menus.index') }}" class="btn-secondary">&larr; Kembali</a>
  </div>

  <form action="{{ route('admin.menus.update', $menu) }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @method('PUT')
    @include('admin.menus._form')

    <div class="form-group full" style="flex-direction: row; gap: 1rem">
      <button type="submit" class="btn-primary">Simpan Perubahan</button>
      <a href="{{ route('admin.menus.index') }}" class="btn-secondary">Batal</a>
    </div>
  </form>

@endsection
