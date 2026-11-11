@extends('layouts.admin')

@section('title', 'Kelola Menu')

@section('content')

  <div class="admin-header">
    <h1>Kelola <span>Menu</span></h1>
    <a href="{{ route('admin.menus.create') }}" class="btn-primary">+ Tambah Menu</a>
  </div>

  <form action="{{ route('admin.menus.index') }}" method="GET" class="filter-bar">
    <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Cari nama menu...">
    <select name="category">
      <option value="">Semua Kategori</option>
      @foreach ($categories as $value => $label)
        <option value="{{ $value }}" @selected(($filters['category'] ?? '') === $value)>{{ $label }}</option>
      @endforeach
    </select>
    <select name="status">
      <option value="">Semua Status</option>
      <option value="tersedia" @selected(($filters['status'] ?? '') === 'tersedia')>Tersedia</option>
      <option value="tidak-tersedia" @selected(($filters['status'] ?? '') === 'tidak-tersedia')>Tidak Tersedia</option>
    </select>
    <button type="submit" class="btn-secondary">Filter</button>
    @if (array_filter($filters ?? []))
      <a href="{{ route('admin.menus.index') }}" class="btn-secondary">Reset</a>
    @endif
  </form>

  @if ($menus->isEmpty())
    <div class="empty-state">
      <p>Tidak ada menu yang ditemukan.</p>
      <p style="margin-top: 1rem">Coba ubah kata pencarian atau filter, atau <a href="{{ route('admin.menus.create') }}" style="color: var(--primary)">tambah menu baru</a>.</p>
    </div>
  @else
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($menus as $menu)
            <tr>
              <td><img class="menu-thumb" src="{{ $menu->imageUrl() }}" alt="{{ $menu->name }}"></td>
              <td>{{ $menu->name }}</td>
              <td>{{ $menu->categoryLabel() }}</td>
              <td>{{ $menu->formatPrice() }}</td>
              <td>
                @if ($menu->is_available)
                  <span class="badge badge-available">Tersedia</span>
                @else
                  <span class="badge badge-unavailable">Tidak Tersedia</span>
                @endif
              </td>
              <td>
                <div class="table-actions">
                  <a href="{{ route('admin.menus.edit', $menu) }}" class="icon-btn">Edit</a>
                  <form action="{{ route('admin.menus.toggle', $menu) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="icon-btn">{{ $menu->is_available ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                  </form>
                  <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Hapus menu &quot;{{ $menu->name }}&quot;? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{ $menus->links('pagination.kopkenjar') }}
  @endif

@endsection
