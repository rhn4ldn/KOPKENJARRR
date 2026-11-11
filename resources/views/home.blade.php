@extends('layouts.app')

@section('title', 'Kopi Kenangan Senja')

@section('content')

  <!-- Hero Section start -->
  <section class="hero" id="home">
    <div class="mask-container">
      <main class="content">
        <h1>Mari Nikmati Secangkir <span>Kopi</span></h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, enim.</p>
      </main>
    </div>
  </section>
  <!-- Hero Section end -->

  <!-- About Section start -->
  <section id="about" class="about">
    <h2><span>Tentang</span> Kami</h2>

    <div class="row">
      <div class="about-img">
        <img src="{{ asset('img/tentang-kami.jpg') }}" alt="Tentang Kami">
      </div>
      <div class="content">
        <h3>Kenapa memilih kopi kami?</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ducimus voluptatum dolor. Et, voluptatum
          accusantium!</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic deserunt iure amet facilis eos a quo cum
          voluptates molestias nihil.</p>
      </div>
    </div>
  </section>
  <!-- About Section end -->

  <!-- Menu Section start -->
  <section id="menu" class="menu">
    <h2><span>Menu</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Expedita, repellendus numquam quam tempora voluptatum.
    </p>

    <div class="row">
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Espresso -</h3>
        <p class="menu-card-price">IDR 15K</p>
      </div>
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Capuccino -</h3>
        <p class="menu-card-price">IDR 25K</p>
      </div>
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Latte -</h3>
        <p class="menu-card-price">IDR 20K</p>
      </div>
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Espresso -</h3>
        <p class="menu-card-price">IDR 15K</p>
      </div>
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Espresso -</h3>
        <p class="menu-card-price">IDR 15K</p>
      </div>
      <div class="menu-card">
        <img src="{{ asset('img/menu/1.jpg') }}" alt="Espresso" class="menu-card-img">
        <h3 class="menu-card-title">- Espresso -</h3>
        <p class="menu-card-price">IDR 15K</p>
      </div>
    </div>
  </section>
  <!-- Menu Section end -->

  <!-- Products Section start -->
  <section class="products" id="products">
    <h2><span>Produk Unggulan</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo unde eum, ab fuga possimus iste.</p>

    <div class="row">
      <div class="product-card">
        <div class="product-icons">
          <a href="#"><i data-feather="shopping-cart"></i></a>
          <a href="#" class="item-detail-button"><i data-feather="eye"></i></a>
        </div>
        <div class="product-image">
          <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        </div>
        <div class="product-content">
          <h3>Coffee Beans 1</h3>
          <div class="product-stars">
            <i data-feather="star" class="star-full"></i>
            <i data-feather="star" class="star-full"></i>
            <i data-feather="star" class="star-full"></i>
            <i data-feather="star" class="star-full"></i>
            <i data-feather="star"></i>
          </div>
          <div class="product-price">IDR 30K <span>IDR 55K</span></div>
        </div>
      </div>
      <div class="product-card">
        <div class="product-icons">
          <a href="#"><i data-feather="shopping-cart"></i></a>
          <a href="#" class="item-detail-button"><i data-feather="eye"></i></a>
        </div>
        <div class="product-image">
          <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        </div>
        <div class="product-content">
          <h3>Coffee Beans 1</h3>
          <div class="product-stars">
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
          </div>
          <div class="product-price">IDR 30K <span>IDR 55K</span></div>
        </div>
      </div>
      <div class="product-card">
        <div class="product-icons">
          <a href="#"><i data-feather="shopping-cart"></i></a>
          <a href="#" class="item-detail-button"><i data-feather="eye"></i></a>
        </div>
        <div class="product-image">
          <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        </div>
        <div class="product-content">
          <h3>Coffee Beans 1</h3>
          <div class="product-stars">
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
          </div>
          <div class="product-price">IDR 30K <span>IDR 55K</span></div>
        </div>
      </div>
    </div>
  </section>
  <!-- Products Section end -->

  <!-- Contact Section start -->
  <section id="contact" class="contact">
    <h2><span>Kontak</span> Kami</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, provident.
    </p>

    <div class="row">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311709235512!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1672408575523!5m2!1sen!2sid"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

      <form action="">
        <div class="input-group">
          <i data-feather="user"></i>
          <input type="text" placeholder="nama">
        </div>
        <div class="input-group">
          <i data-feather="mail"></i>
          <input type="text" placeholder="email">
        </div>
        <div class="input-group">
          <i data-feather="phone"></i>
          <input type="text" placeholder="no hp">
        </div>
        <button type="submit" class="btn">kirim pesan</button>
      </form>

    </div>
  </section>
  <!-- Contact Section end -->

@endsection
