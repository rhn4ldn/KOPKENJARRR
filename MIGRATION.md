# KOPKENJAR — Migrasi "Kedai Kopi Kenangan Senja" ke Laravel

Rekreasi website statis HTML/CSS/JS lama menjadi aplikasi Laravel, mempertahankan desain dan fungsionalitas aslinya.

- **Source (READ-ONLY):** `D:\laragon\www\tugas web kopi\kedai-kopi-kenangan-senja`
- **Destination:** `D:\laragon\www\KOPKENJAR`

## 1. Kondisi Project Lama

Website statis satu halaman (`index.html` + `css/style.css` + `js/script.js`).

Teknologi: HTML, CSS, JavaScript vanilla, Google Fonts (Poppins), Feather Icons via unpkg.com, Google Maps Embed.
Tidak ada backend, database, package.json, bundler, autentikasi, atau API.

Struktur halaman: Navbar → Hero → Tentang Kami → Menu → Produk → Kontak → Footer, ditambah modal detail produk.

## 2. Hasil Reverse Engineering (REA + audit manual)

REA 6.8.0 (`analyze_javascript_application`) menunjukkan graph aplikasi partial, semantic graph unknown, 96 semantic unknowns, inline JS (`feather.replace()`) tidak dianalisis, dan satu parse failure yang tidak teridentifikasi. Karena itu audit dilakukan langsung terhadap source:

- `js/script.js`: toggle hamburger menu, toggle search form + focus, toggle shopping cart, klik-di-luar menutup navbar/search/cart, buka modal via `.item-detail-button`, tutup modal via `.close-icon` dan klik backdrop (`window.onclick`, `e.target === itemDetailModal`).
- Inline script `feather.replace()` di akhir `<body>`.
- CSS: variabel `--primary: #b6895b`, `--bg: #010101`; layout fixed navbar; breakpoints 1366px / 758px / 450px; mask-image hero & gambar tentang-kami (splash.svg).
- Fitur yang TIDAK memiliki implementasi backend (dipertahankan apa adanya): form kontak `action=""` tanpa handler, shopping cart hanya panel visual (3 item hard-coded), tombol checkout/add-to-cart tanpa logika, search tanpa fungsi pencarian, konten menu/produk hard-coded & berulang.

## 3. Mapping Halaman & Komponen

| Bagian lama (index.html) | Hasil Blade |
|---|---|
| `<head>` + navbar + footer + modal | `resources/views/layouts/app.blade.php` + `partials/navbar.blade.php`, `partials/footer.blade.php`, `partials/modal.blade.php` |
| Hero, About, Menu, Products, Contact | `resources/views/home.blade.php` (`@extends('layouts.app')`) |
| `css/style.css` | `public/css/style.css` (disalin apa adanya) |
| `js/script.js` | `public/js/script.js` (disalin apa adanya) |
| `img/*` | `public/img/*` (disalin apa adanya) |
| Route `/` | `routes/web.php` → `view('home')`, nama route `home` |

## 4. Arsitektur Laravel

- Blade layout inheritance (`@extends` / `@section` / `@yield` / `@include`).
- Aset statis disajikan dari `public/` via helper `asset()` (bukan Vite/Tailwind — konfigurasi Vite bawaan dibiarkan utuh dan tidak dipakai karena migrasi CSS apa adanya lebih aman untuk fidelity).
- Tanpa Controller, Model, Migration, Seeder, database — website tidak membutuhkannya.
- Tidak ada dependency baru. `composer.json` / `package.json` tidak diubah.

## 5. Struktur Folder Akhir (yang dibuat/diubah)

```
KOPKENJAR/
├── public/
│   ├── css/style.css          (salinan persis dari source)
│   ├── js/script.js           (salinan persis dari source)
│   └── img/                   (salinan persis dari source)
├── resources/views/
│   ├── layouts/app.blade.php  (BARU)
│   ├── partials/navbar.blade.php (BARU)
│   ├── partials/footer.blade.php (BARU)
│   ├── partials/modal.blade.php  (BARU)
│   └── home.blade.php         (BARU)
├── routes/web.php             (DIUBAH: welcome → home)
├── MIGRATION.md               (BARU, dokumen ini)
└── (file Laravel bawaan lainnya tidak diubah)
```

Catatan: `resources/views/welcome.blade.php` bawaan Laravel dibiarkan ada tetapi tidak dipakai.

## 6. Migrasi HTML → Blade

- Semua path aset relatif (`css/…`, `js/…`, `img/…`) diganti `{{ asset('…') }}`.
- Duplikasi navbar/footer/modal diekstrak ke partials, dipanggil dari layout via `@include`.
- Konten halaman di `home.blade.php` identik dengan `index.html` (hanya path aset yang berubah).
- `route()` tidak dipakai untuk anchor navigasi karena source asli memakai fragment `#home` dsb.; nama route `home` tersedia untuk `/`.

## 7. Migrasi CSS & JavaScript

- CSS disalin byte-per-byte; referensi `../img/…` tetap valid karena struktur `public/css` → `public/img` identik dengan source. Tidak ada perubahan selector, breakpoint, animasi, atau variabel.
- JavaScript disalin byte-per-byte; semua selector DOM (`#hamburger-menu`, `.search-form`, `.shopping-cart`, `#item-detail-modal`, `.item-detail-button`, `.close-icon`) tetap valid.
- Inline `feather.replace()` tetap ada di layout (setelah partials, sebelum script.js), sama seperti source.
- Feather Icons & Google Fonts tetap dimuat dari CDN (unpkg / Google Fonts) seperti source — memerlukan koneksi internet.

## 8. Fitur yang Berhasil Direcreate

- Navbar responsif + hamburger menu (breakpoint 758px)
- Search form toggle + auto focus
- Shopping cart panel toggle (visual saja, seperti asli)
- Klik di luar navbar/search/cart menutup panel masing-masing
- Modal detail produk: buka via tombol eye, tutup via tombol X, tutup via klik backdrop
- Feather Icons dirender (SVG inline)
- Google Maps embed (Bandung)
- Seluruh section & konten identik dengan source

## 9. Hasil Testing (dijalankan, bukan asumsi)

Environment: PHP 8.3.33, Laravel Framework 13.42.0, `php artisan serve --port=8899`, Chrome headless 157 via CDP/Playwright (REA).

- `php artisan route:list` → route `/` (home) terdaftar.
- `php artisan view:cache` → Blade ter-cache tanpa error; `view:clear` setelahnya.
- `GET /` → HTTP 200, memuat hero, modal, link CSS. Semua aset (`/css/style.css`, `/js/script.js`, 7 file gambar) → HTTP 200.
- `inspect_web_page` (CDP, pasif): console events kosong, 0 error JS.
- Scenario interaksi (Playwright): klik `.item-detail-button` → modal tampil (screenshot terverifikasi); klik `.close-icon` → modal `display: none` (DOM terverifikasi); klik `#hamburger-menu` @758px → panel nav tampil; klik `#search-button` → search form tampil; klik `#shopping-cart-button` → cart panel tampil.
- Screenshot section About/Menu/Products terverifikasi visual sesuai desain asli.
- Catatan: screenshot fragment (`#about` dll.) via Chrome headless `--screenshot` menghasilkan layar hitam — perilaku ini IDENTIK pada `file://…/index.html` asli (diverifikasi), jadi bukan bug recreation.
- Laragon (`kopkenjar.test`) belum aktif di mesin ini saat testing; aplikasi diverifikasi via `php artisan serve`.

## 10. Kendala & Penyelesaian

- REA `capture_browser_scenario` mode `connect` gagal (execution_failure) → dipakai mode `launch` dengan Chrome lokal; berhasil.
- Strict mode violation `.item-detail-button` (3 elemen) → selector `.item-detail-button >> nth=0`.
- Screenshot fragment headless hitam → dibandingkan dengan source asli; identik, bukan regresi.
- Vite/Tailwind bawaan Laravel tidak dipakai agar CSS asli tidak perlu direstrukturisasi; konfigurasi Vite dibiarkan utuh.

## 11. Fitur yang Belum/Tidak Diimplementasikan (sesuai source)

- Form kontak: tidak mengirim apa pun (`action=""`), tidak ada handler/backend.
- Shopping cart: hanya panel visual; tidak ada state cart, add-to-cart, hapus item, atau checkout.
- Search: tidak ada fungsi pencarian.
- Tidak ada autentikasi, database, API, atau halaman lain (single page).
- Konten menu & produk masih hard-coded dengan pengulangan (seperti asli).
- Feather Icons & Google Fonts bergantung CDN (online).

## 12. Cara Menjalankan via Laragon

1. Pastikan Laragon berjalan (atau gunakan `php artisan serve`).
2. Akses salah satu:
   - `http://kopkenjar.test` (jika virtual host Laragon mengarah ke `D:\laragon\www\KOPKENJAR\public`), atau
   - `http://localhost/KOPKENJAR/public` (jika Apache melayani `www` secara langsung), atau
   - `cd D:\laragon\www\KOPKENJAR; php artisan serve` → `http://127.0.0.1:8000`
3. Untuk Apache/Nginx Laragon, document root harus menunjuk ke folder `public/`.

Tidak perlu `composer install` / `npm install` (vendor sudah tersedia; tidak ada perubahan dependency). Jika perlu: `php artisan key:generate` sudah memiliki APP_KEY di `.env`.
