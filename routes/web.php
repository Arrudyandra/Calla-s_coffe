<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return file_get_contents(public_path('index.html'));
});

// APIs for Landing Page
Route::get('/api/menus', [OrderController::class, 'getMenus']);
Route::post('/api/orders', [OrderController::class, 'store']);
Route::get('/api/orders/{code}', [OrderController::class, 'track']);

// Admin Dashboard Routes
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateOrderStatus']);
Route::post('/admin/menus/{id}/toggle', [AdminController::class, 'toggleMenuStatus']);
