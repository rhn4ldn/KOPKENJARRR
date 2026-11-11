<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('post')
            ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048']
            : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];

        return [
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', Rule::in(array_keys(Menu::CATEGORIES))],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:1'],
            'compare_price' => ['nullable', 'integer', 'min:1', 'gt:price'],
            'image' => $imageRule,
            'is_available' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama menu wajib diisi.',
            'name.max' => 'Nama menu maksimal 255 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori yang dipilih tidak valid.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa angka.',
            'price.min' => 'Harga harus lebih dari 0.',
            'compare_price.integer' => 'Harga coret harus berupa angka.',
            'compare_price.gt' => 'Harga coret harus lebih besar dari harga jual.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_available' => $this->boolean('is_available'),
        ]);
    }
}
