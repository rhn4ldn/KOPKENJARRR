<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kopkenjar.test'],
            [
                'name' => 'Admin KOPKENJAR',
                'password' => Hash::make('admin123'),
            ]
        )->forceFill(['is_admin' => true])->save();

        $this->seedMenuImage('public/img/menu/1.jpg', 'menus/kopi.jpg');
        $this->seedMenuImage('public/img/products/1.jpg', 'menus/coffee-beans.jpg');

        $menus = [
            [
                'name' => 'Espresso',
                'category' => 'kopi',
                'description' => 'Espresso pekat dengan karakter kuat dan khas — pilihan tepat untuk memulai hari atau sekadar pengen keluar dari kantuk.',
                'price' => 15000,
                'compare_price' => null,
                'image' => 'menus/kopi.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Capuccino',
                'category' => 'kopi',
                'description' => 'Perpaduan espresso, susu hangat, dan foam yang lembut — creamy di setiap tegukan, pas untuk sore yang santai.',
                'price' => 25000,
                'compare_price' => null,
                'image' => 'menus/kopi.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Latte',
                'category' => 'kopi',
                'description' => 'Espresso dengan susu yang lebih banyak dan rasa yang lebih lembut — pilihan ringan untuk menemani obrolan hangat.',
                'price' => 20000,
                'compare_price' => null,
                'image' => 'menus/kopi.jpg',
                'is_available' => true,
            ],
            [
                'name' => 'Coffee Beans 1',
                'category' => 'biji-kopi',
                'description' => 'Biji kopi pilihan dari Kedai Kopi Kenangan Senja, cocok untuk kamu yang ingin menyeduh kopi sendiri di rumah. Karakternya hangat dan seimbang — pas menemani sore yang tenang, seperti suasana di kedai kami.',
                'price' => 30000,
                'compare_price' => 55000,
                'image' => 'menus/coffee-beans.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(['name' => $menu['name']], $menu);
        }
    }

    private function seedMenuImage(string $source, string $destination): void
    {
        $sourcePath = base_path($source);

        if (file_exists($sourcePath) && ! Storage::disk('public')->exists($destination)) {
            Storage::disk('public')->put($destination, file_get_contents($sourcePath));
        }
    }
}
