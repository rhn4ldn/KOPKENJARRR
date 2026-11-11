<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MenuCatalogTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::forceCreate([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => 'secret123',
            'is_admin' => true,
        ]);
    }

    private function buatMenu(array $override = []): Menu
    {
        return Menu::create(array_merge([
            'name' => 'Es Kopi Test',
            'category' => 'kopi',
            'description' => 'Kopi dingin untuk pengujian.',
            'price' => 20000,
            'is_available' => true,
        ], $override));
    }

    public function test_halaman_home_tampil_dan_menampilkan_menu_dari_database(): void
    {
        $this->buatMenu(['name' => 'Kopi Unik XYZ']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kopi Unik XYZ');
    }

    public function test_menu_tidak_tersedia_menampilkan_penanda(): void
    {
        $this->buatMenu(['name' => 'Kopi Habis', 'is_available' => false]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kopi Habis')
            ->assertSee('Tidak Tersedia');
    }

    public function test_tamu_diarahkan_ke_login_saat_membuka_halaman_admin(): void
    {
        $this->get('/admin/menus')->assertRedirect(route('admin.login'));
    }

    public function test_pengguna_non_admin_mendapat_403(): void
    {
        $user = User::forceCreate([
            'name' => 'Bukan Admin',
            'email' => 'user@test.com',
            'password' => 'secret123',
            'is_admin' => false,
        ]);

        $this->actingAs($user)->get('/admin/menus')->assertForbidden();
    }

    public function test_admin_bisa_membuat_menu_beserta_foto(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post('/admin/menus', [
                'name' => 'Menu Baru',
                'category' => 'nonkopi',
                'description' => 'Deskripsi menu baru.',
                'price' => 18000,
                'is_available' => '1',
                'image' => UploadedFile::fake()->image('menu.jpg', 400, 400),
            ])
            ->assertRedirect(route('admin.menus.index'));

        $menu = Menu::where('name', 'Menu Baru')->firstOrFail();
        Storage::disk('public')->assertExists($menu->image);
    }

    public function test_validasi_harga_dan_wajib_isi_berjalan(): void
    {
        $this->actingAs($this->admin())
            ->post('/admin/menus', [
                'name' => '',
                'category' => 'kopi',
                'price' => -5,
            ])
            ->assertSessionHasErrors(['name', 'price']);
    }

    public function test_validasi_foto_menolak_file_non_gambar(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())
            ->post('/admin/menus', [
                'name' => 'Menu Foto',
                'category' => 'kopi',
                'price' => 10000,
                'image' => UploadedFile::fake()->create('file.pdf', 100, 'application/pdf'),
            ])
            ->assertSessionHasErrors(['image']);
    }

    public function test_admin_bisa_mengubah_dan_menghapus_menu(): void
    {
        $admin = $this->admin();
        $menu = $this->buatMenu();

        $this->actingAs($admin)
            ->put("/admin/menus/{$menu->id}", [
                'name' => 'Kopi Diubah',
                'category' => 'makanan',
                'price' => 25000,
            ])
            ->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseHas('menus', ['name' => 'Kopi Diubah', 'category' => 'makanan', 'price' => 25000]);

        $this->actingAs($admin)
            ->delete("/admin/menus/{$menu->id}")
            ->assertRedirect(route('admin.menus.index'));

        $this->assertDatabaseMissing('menus', ['id' => $menu->id]);
    }

    public function test_admin_bisa_mengubah_ketersediaan(): void
    {
        $menu = $this->buatMenu(['is_available' => true]);

        $this->actingAs($this->admin())
            ->patch("/admin/menus/{$menu->id}/toggle")
            ->assertRedirect();

        $this->assertFalse($menu->fresh()->is_available);
    }

    public function test_pencarian_dan_filter_admin_bekerja(): void
    {
        $this->buatMenu(['name' => 'Americano Spesial', 'category' => 'kopi']);
        $this->buatMenu(['name' => 'Teh Manis', 'category' => 'nonkopi']);

        $admin = $this->admin();

        $this->actingAs($admin)
            ->get('/admin/menus?q=Americano')
            ->assertOk()
            ->assertSee('Americano Spesial')
            ->assertDontSee('Teh Manis');

        $this->actingAs($admin)
            ->get('/admin/menus?category=nonkopi')
            ->assertOk()
            ->assertSee('Teh Manis')
            ->assertDontSee('Americano Spesial');
    }

    public function test_admin_login_dengan_kredensial_benar(): void
    {
        $this->admin();

        $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'secret123',
        ])->assertRedirect(route('admin.menus.index'));
    }

    public function test_admin_login_ditolak_untuk_non_admin(): void
    {
        User::forceCreate([
            'name' => 'Bukan Admin',
            'email' => 'user@test.com',
            'password' => 'secret123',
            'is_admin' => false,
        ]);

        $this->post('/admin/login', [
            'email' => 'user@test.com',
            'password' => 'secret123',
        ])->assertSessionHasErrors('email');
    }
}
