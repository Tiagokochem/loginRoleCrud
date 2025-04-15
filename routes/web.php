<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard com estatísticas
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $products = Product::all();

    return Inertia::render('Dashboard', [
        'user' => auth()->user(),
        'stats' => [
            'total' => $products->count(),
            'quantidade' => $products->sum('quantity'),
            'valor' => $products->sum(fn($p) => $p->price * $p->quantity),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil do usuário autenticado
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas de Produtos (painel web)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->get('/products', [ProductController::class, 'index'])->name('products.index');


Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/products/create', function () {
        return Inertia::render('Products/Create', [
            'user' => auth()->user(),
            'categories' => Category::select('id', 'name')->get(),
        ]);
    })->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
});


/*
|--------------------------------------------------------------------------
| Rotas de Categorias (painel web)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
});

Route::get('/dev/clear-cache', function () {
    cache()->forget('categories.all');
    return 'Cache de categorias limpo!';
});


/*
|--------------------------------------------------------------------------
| Autenticação (Laravel Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
