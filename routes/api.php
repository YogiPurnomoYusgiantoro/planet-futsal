<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;

Route::post('/admin/register', [AdminAuthController::class, 'register']);