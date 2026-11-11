@csrf

<div class="form-group full">
  <label for="name">Nama Menu *</label>
  <input type="text" id="name" name="name" value="{{ old('name', $menu->name ?? '') }}" placeholder="Contoh: Es Kopi Susu Senja" required>
  @error('name') <span class="form-error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
  <label for="category">Kategori *</label>
  <select id="category" name="category" required>
    <option value="">Pilih kategori...</option>
    @foreach ($categories as $value => $label)
      <option value="{{ $value }}" @selected(old('category', $menu->category ?? '') === $value)>{{ $label }}</option>
    @endforeach
  </select>
  @error('category') <span class="form-error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
  <label for="price">Harga (IDR) *</label>
  <input type="number" id="price" name="price" min="1" step="1" value="{{ old('price', $menu->price ?? '') }}" placeholder="Contoh: 20000" required>
  @error('price') <span class="form-error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
  <label for="compare_price">Harga Coret (IDR, opsional)</label>
  <input type="number" id="compare_price" name="compare_price" min="1" step="1" value="{{ old('compare_price', $menu->compare_price ?? '') }}" placeholder="Contoh: 55000">
  @error('compare_price') <span class="form-error">{{ $message }}</span> @enderror
</div>

<div class="form-group full">
  <label for="description">Deskripsi</label>
  <textarea id="description" name="description" rows="3" placeholder="Ceritakan singkat tentang menu ini...">{{ old('description', $menu->description ?? '') }}</textarea>
  @error('description') <span class="form-error">{{ $message }}</span> @enderror
</div>

<div class="form-group full">
  <label for="image">Foto Menu (JPG, PNG, WEBP — maks. 2 MB)</label>
  <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" onchange="previewMenuImage(event)">
  @error('image') <span class="form-error">{{ $message }}</span> @enderror
  <div class="image-preview">
    <img id="image-preview" src="{{ isset($menu) && $menu->image ? $menu->imageUrl() : asset('img/menu/1.jpg') }}" alt="Pratinjau foto menu" style="{{ isset($menu) && $menu->image ? '' : 'opacity:.35' }}">
  </div>
</div>

<div class="form-group full">
  <label class="checkbox-row">
    <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $menu->is_available ?? true))>
    <span>Menu tersedia untuk dipesan</span>
  </label>
</div>

<script>
  function previewMenuImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('image-preview');
    if (file && preview) {
      preview.src = URL.createObjectURL(file);
      preview.style.opacity = '1';
    }
  }
</script>
