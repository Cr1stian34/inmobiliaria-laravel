<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    //Campos que se agregaran
    protected $fillable = [
        'titulo',
        'precio',
        'ubicacion',
        'callep',
        'contacto',
        'descripcion',
        'estado',
        'imagen',
        'categoria_id',

    ];
    //Obtiene la categoria de la receta via key foranea

    public function categoria(){
        return $this->belongsTo(CategoriaHabitacion::class);
    }

    //Obtiene la informacion del usuario via FK
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //Calificacion que ha recibido una publicacion
    public function likes(){
        return $this->belongsToMany(User::class,'likes_habitacion');
    }

    use HasFactory;
}
