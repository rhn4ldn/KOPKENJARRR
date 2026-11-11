// Toggle class active untuk hamburger menu
const navbarNav = document.querySelector('.navbar-nav');
// ketika hamburger menu di klik
document.querySelector('#hamburger-menu').onclick = () => {
  navbarNav.classList.toggle('active');
};

// Toggle class active untuk search form
const searchForm = document.querySelector('.search-form');
const searchBox = document.querySelector('#search-box');

document.querySelector('#search-button').onclick = (e) => {
  searchForm.classList.toggle('active');
  searchBox.focus();
  e.preventDefault();
};

// Toggle class active untuk shopping cart
const shoppingCart = document.querySelector('.shopping-cart');
document.querySelector('#shopping-cart-button').onclick = (e) => {
  shoppingCart.classList.toggle('active');
  e.preventDefault();
};

// Klik di luar elemen
const hm = document.querySelector('#hamburger-menu');
const sb = document.querySelector('#search-button');
const sc = document.querySelector('#shopping-cart-button');

document.addEventListener('click', function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove('active');
  }

  if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
    searchForm.classList.remove('active');
  }

  if (!sc.contains(e.target) && !shoppingCart.contains(e.target)) {
    shoppingCart.classList.remove('active');
  }
});

// Modal Box
const itemDetailModal = document.querySelector('#item-detail-modal');
const itemDetailButtons = document.querySelectorAll('.item-detail-button');

itemDetailButtons.forEach((btn) => {
  btn.onclick = (e) => {
    itemDetailModal.style.display = 'flex';
    e.preventDefault();
  };
});

// klik tombol close modal
document.querySelector('.modal .close-icon').onclick = (e) => {
  itemDetailModal.style.display = 'none';
  e.preventDefault();
};

// klik di luar modal
window.onclick = (e) => {
  if (e.target === itemDetailModal) {
    itemDetailModal.style.display = 'none';
  }
};

// Katalog: pencarian nama & filter kategori (client-side)
const menuSearch = document.querySelector('#menu-search');
const menuCategoryFilter = document.querySelector('#menu-category-filter');
const menuCards = document.querySelectorAll('#menu-list .menu-card');
const menuFilterEmpty = document.querySelector('#menu-filter-empty');

function applyMenuFilter() {
  const q = menuSearch.value.trim().toLowerCase();
  const cat = menuCategoryFilter.value;
  let visible = 0;

  menuCards.forEach((card) => {
    const matchName = !q || (card.dataset.name || '').includes(q);
    const matchCategory = !cat || card.dataset.category === cat;
    const show = matchName && matchCategory;
    card.style.display = show ? '' : 'none';
    if (show) visible++;
  });

  if (menuFilterEmpty) {
    menuFilterEmpty.hidden = visible !== 0;
  }
}

if (menuSearch && menuCategoryFilter) {
  menuSearch.addEventListener('input', applyMenuFilter);
  menuCategoryFilter.addEventListener('change', applyMenuFilter);
}

// Modal detail produk: isi konten dari data produk yang diklik
const modalImage = document.querySelector('#modal-image');
const modalName = document.querySelector('#modal-name');
const modalDescription = document.querySelector('#modal-description');
const modalPrice = document.querySelector('#modal-price');

itemDetailButtons.forEach((btn) => {
  btn.addEventListener('click', () => {
    if (btn.dataset.name && modalName) {
      modalName.textContent = btn.dataset.name;
    }
    if (modalDescription) {
      modalDescription.textContent = btn.dataset.description || '';
      modalDescription.style.display = btn.dataset.description ? '' : 'none';
    }
    if (btn.dataset.image && modalImage) {
      modalImage.src = btn.dataset.image;
      modalImage.alt = btn.dataset.name || 'Produk';
    }
    if (modalPrice && btn.dataset.price) {
      modalPrice.innerHTML = btn.dataset.comparePrice
        ? btn.dataset.price + ' <span>' + btn.dataset.comparePrice + '</span>'
        : btn.dataset.price;
    }
  });
});
