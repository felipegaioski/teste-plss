<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AccessLevelController;

// Route::get('/', function () { return view('site.home'); });
Route::get('/', [Controller::class, 'get'] );

//users
Route::get('/usuarios', [UserController::class, 'get']);
Route::get('/usuarios/novo', [UserController::class, 'createPage']);
Route::post('/usuarios/novo', [UserController::class, 'store']);
Route::post('/usuarios/login', [UserController::class, 'login']);
Route::post('/usuarios/logout', [UserController::class, 'logout']);
Route::get('/usuarios/{id}/editar', [UserController::class, 'edit']);
Route::post('/usuarios/{id}/editar', [UserController::class, 'update']);
Route::delete('/usuarios/{id}/excluir', [UserController::class, 'destroy']);

//access-levels
Route::get('/niveis-de-acesso', [AccessLevelController::class, 'get']);
Route::get('/niveis-de-acesso/novo', function () { return view('site.access-levels.create'); });
Route::post('/niveis-de-acesso/novo', [AccessLevelController::class, 'store']);
Route::get('/niveis-de-acesso/{id}/editar', [AccessLevelController::class, 'edit']);
Route::post('/niveis-de-acesso/{id}/editar', [AccessLevelController::class, 'update']);

Route::get('new-permission-category/{category_name}/{category_type}/{unique_permission?}/{unique_name?}', [AccessLevelController::class, 'new_permission_category']);

//chamados
Route::get('/chamados', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/chamados/novo', [TicketController::class, 'createPage']);
Route::post('/chamados/novo', [TicketController::class, 'store']);
Route::get('/chamados/{id}/editar', [TicketController::class, 'edit']);
Route::post('/chamados/{id}/editar', [TicketController::class, 'update']);
Route::post('/chamados/{id}/iniciar', [TicketController::class, 'start']);
Route::post('/chamados/{id}/finalizar', [TicketController::class, 'finish']);
Route::post('/chamados/{id}/excluir', [TicketController::class, 'destroy']);

//dashboard
Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');;

//categories
Route::get('/categorias', [CategoryController::class, 'get']);


