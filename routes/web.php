<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Default: home, dashboard, dll
Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect-by-role', function () {
    $user = Auth::user();

    if ($user->hasRole('guest')) {
        return redirect()->route('guest.items.index');
    } elseif ($user->hasRole('user')) {
        return redirect()->route('user.items.index');
    } elseif ($user->hasRole('fat')) {
        return redirect()->route('fat.items.index');
    } elseif ($user->hasRole('procurement')) {
        return redirect()->route('procurement.items.index');
    } elseif ($user->hasRole('logistik')) {
        return redirect()->route('logistik.items.index');
    }
})->name('redirect-by-role');

// Guest routes
Route::middleware(['auth', 'role:guest'])->prefix('guest')->name('guest.')->group(function () {
    Route::get('/items', [ItemController::class, 'guestIndex'])->name('items.index');
    Route::post('/items/{id}/select', [ItemController::class, 'guestSelectItem'])->name('items.select');
    Route::get('/items/selected', [ItemController::class, 'guestSelectedItems'])->name('items.selected');
    Route::delete('/items/deselect/{id}', [ItemController::class, 'guestDeselectItem'])->name('items.deselect');
});

// User admin
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/items', [ItemController::class, 'userIndex'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'userCreate'])->name('items.create');
    Route::post('/items', [ItemController::class, 'userStore'])->name('items.store');
    Route::get('/items/{id}/edit', [ItemController::class, 'userEdit'])->name('items.edit');
    Route::put('/items/{id}', [ItemController::class, 'userUpdate'])->name('items.update');
    Route::delete('/items/{id}', [ItemController::class, 'userDestroy'])->name('items.destroy');
    Route::put('/items/{id}/submit', [ItemController::class, 'userSubmit'])->name('items.submit');
});

// FAT admin
Route::middleware(['auth', 'role:fat'])->prefix('fat')->name('fat.')->group(function () {
    Route::get('/items', [ItemController::class, 'fatIndex'])->name('items.index');
    Route::get('/items/{item}/edit', [ItemController::class, 'fatEdit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'fatUpdate'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::put('/items/{id}/submit', [ItemController::class, 'fatSubmit'])->name('items.submit');
});

// Procurement admin
Route::middleware(['auth', 'role:procurement'])->prefix('procurement')->name('procurement.')->group(function () {
    Route::get('/items', [ItemController::class, 'procIndex'])->name('items.index');
    Route::get('/items/{item}/edit', [ItemController::class, 'procEdit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'procUpdate'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::put('/items/{id}/submit', [ItemController::class, 'procSubmit'])->name('items.submit');
});

// Logistik admin
Route::middleware(['auth', 'role:logistik'])->prefix('logistik')->name('logistik.')->group(function () {
    Route::get('/items', [ItemController::class, 'logistikIndex'])->name('items.index');
    Route::get('/items/{item}/edit', [ItemController::class, 'logistikEdit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'logistikUpdate'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::put('/items/{id}/submit', [ItemController::class, 'logistikSubmit'])->name('items.submit');
});

require __DIR__.'/auth.php';
