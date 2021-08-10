<?php

namespace App\Providers;

use App\Models\CategoriaHabitacion;
use View;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $categorias = CategoriaHabitacion::all();
            $view->with('categorias',$categorias);
        });
    }
}
