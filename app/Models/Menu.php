<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    public const CATEGORIES = [
        'kopi' => 'Kopi',
        'nonkopi' => 'Non Kopi',
        'makanan' => 'Makanan',
        'biji-kopi' => 'Biji Kopi',
    ];

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'compare_price',
        'image',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'compare_price' => 'integer',
            'is_available' => 'boolean',
        ];
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    public function imageUrl(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('img/menu/1.jpg');
    }

    public function formatPrice(?int $value = null): string
    {
        $value = $value ?? $this->price;

        if ($value % 1000 === 0) {
            return 'IDR ' . ($value / 1000) . 'K';
        }

        return 'IDR ' . number_format($value, 0, ',', '.');
    }

    public static function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
