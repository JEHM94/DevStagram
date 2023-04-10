<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

// Auth
// Iniciar Sesión
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
// Cerrar Sesión
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
// Registrarse
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// Posts
// Perfil del Usuario
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

// Mostrar Formulario de Crear Post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// Crear Post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Mostrar Post
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Comentar el Post
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
// Eliminar el Post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Subida de Imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');


// Likes
// Guarda el Like
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
// Elimina el Like
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Edición de Peril de Usuario
Route::get('/{user:username}/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/{user:username}/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

