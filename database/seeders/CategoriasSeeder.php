<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_habitacions')->insert([
             'nombre' => 'Habitaciones',
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_habitacions')->insert([
            'nombre' => 'Cuartos compartidos',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
       ]);

       DB::table('categoria_habitacions')->insert([
        'nombre' => 'Departamentos',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
       ]);

       DB::table('categoria_habitacions')->insert([
        'nombre' => 'Casas',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
       ]);
    }
}
