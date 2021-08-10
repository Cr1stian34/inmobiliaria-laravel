<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'InicioController@index')->name('inicio.index');

//Route::get('/habitaciones','HabitacionController');

Route::get('/habitaciones', 'HabitacionController@index')->name('habitaciones.index');
Route::get('/habitaciones/create', 'HabitacionController@create')->name('habitaciones.create');
Route::post('/habitaciones', 'HabitacionController@store')->name('habitaciones.store');
Route::get('/habitaciones/{habitacion}', 'HabitacionController@show')->name('habitaciones.show');
Route::get('/habitaciones/{habitacion}/edit', 'HabitacionController@edit')->name('habitaciones.edit');
Route::put('/habitaciones/{habitacion}', 'HabitacionController@update')->name('habitaciones.update');
Route::delete('/habitaciones/{habitacion}', 'HabitacionController@destroy')->name('habitaciones.destroy');

Route::get('/categoria/{categoriaHabitacion}','CategoriasController@show')->name('categorias.show');
//Buscador de Publicaciones
Route::get('/buscar','HabitacionController@search')->name('buscar.show');

Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');
Auth::routes();

//Almacena las calificaciones de las recetas
Route::post('/habitaciones/{habitacion}', 'LikesController@update')->name('likes.update');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
