  <!-- Navbar start -->
  <nav class="navbar">
    <a href="#" class="navbar-logo">kenangan<span>senja</span>.</a>

    <div class="navbar-nav">
      <a href="#home">Beranda</a>
      <a href="#about">Tentang Kami</a>
      <a href="#menu">Menu</a>
      <a href="#products">Produk</a>
      <a href="#contact">Kontak</a>
      @guest
        <a href="{{ route('login') }}">Masuk</a>
      @else
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
          @csrf
        </form>
      @endguest
    </div>

    <div class="navbar-extra">
      <a href="#" id="search-button"><i data-feather="search"></i></a>
      <a href="#" id="shopping-cart-button"><i data-feather="shopping-cart"></i></a>
      <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>

    <!-- Search Form start -->
    <div class="search-form">
      <input type="search" id="search-box" placeholder="Cari menu atau produk...">
      <label for="search-box"><i data-feather="search"></i></label>
    </div>
    <!-- Search Form end -->

    <!-- Shopping Cart start -->
    <div class="shopping-cart">
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Coffee Beans 1 — biji kopi Kedai Kopi Kenangan Senja">
        <div class="item-detail">
          <h3>Coffee Beans 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Coffee Beans 1 — biji kopi Kedai Kopi Kenangan Senja">
        <div class="item-detail">
          <h3>Coffee Beans 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Coffee Beans 1 — biji kopi Kedai Kopi Kenangan Senja">
        <div class="item-detail">
          <h3>Coffee Beans 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
    </div>
    <!-- Shopping Cart end -->

  </nav>
  <!-- Navbar end -->
