<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MenuController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'menuItems' => Menu::whereIn('category', ['kopi', 'nonkopi', 'makanan'])
            ->orderBy('category')
            ->orderBy('name')
            ->get(),
        'produkItems' => Menu::where('category', 'biji-kopi')
            ->orderBy('name')
            ->get(),
        'customerCategories' => collect(Menu::CATEGORIES)->only(['kopi', 'nonkopi', 'makanan']),
    ]);
})->name('home');

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.menus.index'))->name('dashboard');
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::patch('menus/{menu}/toggle', [MenuController::class, 'toggle'])->name('menus.toggle');
});

Auth::routes();
