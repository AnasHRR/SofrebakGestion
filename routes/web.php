<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesProduitsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CommandeClientController;
use App\Http\Controllers\CommandesFournisseursController;
use App\Http\Controllers\ExpeditionsController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// ── Public Routes ──
Route::view('/' , 'app.index');

// ── Auth Routes (guests only) ──
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ── Logout ──
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── Protected Routes (auth required) ──
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'daschboard.index');
    Route::resource('/clients', ClientsController::class);
    Route::resource('/stock', StockController::class);
    Route::resource('/produits', ProduitsController::class);
    Route::resource('/fournisseurs', FournisseursController::class);
    Route::resource('/categories', CategoriesProduitsController::class);
    Route::resource('/commandes', CommandeClientController::class);
    Route::resource('/commandes-fournisseurs', CommandesFournisseursController::class)->names('commandesFournisseurs');
    Route::resource('/factures', FacturesController::class);
    Route::resource('/expeditions', ExpeditionsController::class);
});
