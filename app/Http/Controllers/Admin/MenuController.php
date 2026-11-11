<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $menus = Menu::query()
            ->when($request->filled('q'), fn ($query) => $query->where('name', 'like', '%' . $request->string('q') . '%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('is_available', $request->string('status') === 'tersedia');
            })
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.menus.index', [
            'menus' => $menus,
            'categories' => Menu::CATEGORIES,
            'filters' => $request->only(['q', 'category', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('admin.menus.create', ['categories' => Menu::CATEGORIES]);
    }

    public function store(MenuRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu): View
    {
        return view('admin.menus.edit', [
            'menu' => $menu,
            'categories' => Menu::CATEGORIES,
        ]);
    }

    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Menu::deleteImage($menu->image);
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        Menu::deleteImage($menu->image);
        $menu->delete();

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }

    public function toggle(Menu $menu): RedirectResponse
    {
        $menu->update(['is_available' => ! $menu->is_available]);

        return back()->with('success', 'Status ketersediaan "' . $menu->name . '" berhasil diubah.');
    }
}
