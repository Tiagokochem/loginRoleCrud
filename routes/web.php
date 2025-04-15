<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/dashboard', function () {
    $products = Product::all();

    return Inertia::render('Dashboard', [
        'user' => auth()->user(),
        'stats' => [
            'total' => $products->count(),
            'quantidade' => $products->sum('quantity'),
            'valor' => $products->sum(fn ($p) => $p->price * $p->quantity),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->get('/products', function () {
    return Inertia::render('Products/Index', [
        'products' => Product::all(),
        'user' => auth()->user(),
    ]);
})->name('products.index');

Route::middleware(['auth', CheckRole::class . ':admin'])->get('/products/create', function () {
    return Inertia::render('Products/Create', [
        'user' => auth()->user(),
        'categories' => Category::select('id', 'name')->get(),
    ]);
})->name('products.create');


Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
});


require __DIR__.'/auth.php';
