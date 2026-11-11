@extends('layouts.app')

@section('title', 'Kedai Kopi Kenangan Senja | Kopi Hangat, Suasana Senja')

@section('content')

  <!-- Hero Section start -->
  <section class="hero" id="home">
    <div class="mask-container">
      <main class="content">
        <h1>Mari Nikmati Secangkir <span>Kopi</span></h1>
        <p>Selamat datang di Kedai Kopi Kenangan Senja — tempat singgah untuk menikmati kopi hangat dengan suasana senja yang tenang dan bersahabat.</p>
      </main>
    </div>
  </section>
  <!-- Hero Section end -->

  <!-- About Section start -->
  <section id="about" class="about">
    <h2><span>Tentang</span> Kami</h2>

    <div class="row">
      <div class="about-img">
        <img src="{{ asset('img/tentang-kami.jpg') }}" alt="Suasana hangat dan nyaman di dalam Kedai Kopi Kenangan Senja">
      </div>
      <div class="content">
        <h3>Kenapa Kopi Kenangan Senja?</h3>
        <p>Kedai Kopi Kenangan Senja adalah kedai kopi dengan suasana hangat, santai, dan nyaman — tempat yang pas untuk menikmati secangkir kopi sambil berbincang, bekerja, atau sekadar beristirahat sejenak dari aktivitas harian.</p>
        <p>Nama Kenangan Senja terinspirasi dari momen senja yang tenang dan hangat, saat hari mulai mereda dan secangkir kopi terasa paling nikmat. Setiap kunjungan ingin kami buat terasa seperti pulang — sederhana, akrab, dan berkesan.</p>
      </div>
    </div>
  </section>
  <!-- About Section end -->

  <!-- Menu Section start -->
  <section id="menu" class="menu">
    <h2><span>Menu</span> Kami</h2>
    <p>Dari espresso yang pekat hingga latte yang lembut dan cappuccino yang creamy — semua diracik untuk menemani momen santaimu, kapan pun kamu datang.</p>

    <div class="menu-filter">
      <input type="search" id="menu-search" placeholder="Cari menu..." aria-label="Cari menu">
      <select id="menu-category-filter" aria-label="Filter kategori">
        <option value="">Semua Kategori</option>
        @foreach ($customerCategories as $value => $label)
          <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="row" id="menu-list">
      @forelse ($menuItems as $menu)
        <div class="menu-card {{ $menu->is_available ? '' : 'is-unavailable' }}" data-name="{{ strtolower($menu->name) }}" data-category="{{ $menu->category }}">
          @unless ($menu->is_available)
            <span class="badge-unavailable">Tidak Tersedia</span>
          @endunless
          <img src="{{ $menu->imageUrl() }}" alt="{{ $menu->name }} Kedai Kopi Kenangan Senja" class="menu-card-img">
          <h3 class="menu-card-title">- {{ $menu->name }} -</h3>
          @if ($menu->description)
            <p class="menu-card-desc">{{ $menu->description }}</p>
          @endif
          <p class="menu-card-price">{{ $menu->formatPrice() }}</p>
        </div>
      @empty
        <p class="empty-state">Belum ada menu yang tersedia saat ini. Silakan cek kembali nanti.</p>
      @endforelse
    </div>
    <p class="empty-state menu-filter-empty" id="menu-filter-empty" hidden>Tidak ada menu yang cocok dengan pencarianmu.</p>
  </section>
  <!-- Menu Section end -->

  <!-- Products Section start -->
  <section class="products" id="products">
    <h2><span>Produk Unggulan</span> Kami</h2>
    <p>Biji kopi pilihan kami untuk kamu yang ingin membawa pulang cita rasa Kenangan Senja dan menyeduhnya sendiri di rumah.</p>

    <div class="row">
      @forelse ($produkItems as $produk)
        <div class="product-card {{ $produk->is_available ? '' : 'is-unavailable' }}">
          @unless ($produk->is_available)
            <span class="badge-unavailable">Tidak Tersedia</span>
          @endunless
          <div class="product-icons">
            <a href="#"><i data-feather="shopping-cart"></i></a>
            <a href="#" class="item-detail-button"
               data-name="{{ $produk->name }}"
               data-description="{{ $produk->description }}"
               data-price="{{ $produk->formatPrice() }}"
               data-compare-price="{{ $produk->compare_price ? $produk->formatPrice($produk->compare_price) : '' }}"
               data-image="{{ $produk->imageUrl() }}"><i data-feather="eye"></i></a>
          </div>
          <div class="product-image">
            <img src="{{ $produk->imageUrl() }}" alt="{{ $produk->name }} — biji kopi pilihan Kedai Kopi Kenangan Senja">
          </div>
          <div class="product-content">
            <h3>{{ $produk->name }}</h3>
            @if ($produk->description)
              <p class="product-desc">{{ $produk->description }}</p>
            @endif
            <div class="product-stars">
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star" class="star-full"></i>
              <i data-feather="star"></i>
            </div>
            <div class="product-price">{{ $produk->formatPrice() }}@if ($produk->compare_price) <span>{{ $produk->formatPrice($produk->compare_price) }}</span>@endif</div>
          </div>
        </div>
      @empty
        <p class="empty-state">Belum ada produk yang tersedia saat ini.</p>
      @endforelse
    </div>
  </section>
  <!-- Products Section end -->

  <!-- Contact Section start -->
  <section id="contact" class="contact">
    <h2><span>Kontak</span> Kami</h2>
    <p>Punya pertanyaan, kritik, atau sekadar ingin menyapa? Kami senang mendengar dari kamu — hubungi Kedai Kopi Kenangan Senja melalui formulir di bawah ini.</p>

    <div class="row">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311709235512!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1672408575523!5m2!1sen!2sid"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map" title="Peta lokasi Kedai Kopi Kenangan Senja, Bandung"></iframe>

      <form action="">
        <div class="input-group">
          <i data-feather="user"></i>
          <input type="text" placeholder="Nama kamu">
        </div>
        <div class="input-group">
          <i data-feather="mail"></i>
          <input type="text" placeholder="Email kamu">
        </div>
        <div class="input-group">
          <i data-feather="phone"></i>
          <input type="text" placeholder="Nomor HP / WhatsApp">
        </div>
        <button type="submit" class="btn">Kirim Pesan</button>
      </form>

    </div>
  </section>
  <!-- Contact Section end -->

@endsection
