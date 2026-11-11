  <!-- Navbar start -->
  <nav class="navbar">
    <a href="#" class="navbar-logo">kenangan<span>senja</span>.</a>

    <div class="navbar-nav">
      <a href="#home">Home</a>
      <a href="#about">Tentang Kami</a>
      <a href="#menu">Menu</a>
      <a href="#products">Produk</a>
      <a href="#contact">Kontak</a>
    </div>

    <div class="navbar-extra">
      <a href="#" id="search-button"><i data-feather="search"></i></a>
      <a href="#" id="shopping-cart-button"><i data-feather="shopping-cart"></i></a>
      <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
    </div>

    <!-- Search Form start -->
    <div class="search-form">
      <input type="search" id="search-box" placeholder="search here...">
      <label for="search-box"><i data-feather="search"></i></label>
    </div>
    <!-- Search Form end -->

    <!-- Shopping Cart start -->
    <div class="shopping-cart">
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        <div class="item-detail">
          <h3>Product 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        <div class="item-detail">
          <h3>Product 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
      <div class="cart-item">
        <img src="{{ asset('img/products/1.jpg') }}" alt="Product 1">
        <div class="item-detail">
          <h3>Product 1</h3>
          <div class="item-price">IDR 30K</div>
        </div>
        <i data-feather="trash-2" class="remove-item"></i>
      </div>
    </div>
    <!-- Shopping Cart end -->

  </nav>
  <!-- Navbar end -->
