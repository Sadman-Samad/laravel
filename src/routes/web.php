<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\LoginapiController;


Route::get('/', function () {
    return 'Laravel is running!';
});





// Route::get('/home', [HomeController::class, 'index'])->middleware('auth');



Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// Route::post('/api/login', [LoginapiController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

use Illuminate\Http\Request;

Route::get('/csrf-token', function (Request $request) {
    // Option 1: Using the helper
    $token = csrf_token();

    // Option 2: From the session
    $sessionToken = $request->session()->token();

    return response()->json([
        'csrf_token_helper' => $token,
        'csrf_token_session' => $sessionToken
    ]);
});
