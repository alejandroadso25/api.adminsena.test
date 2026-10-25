<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training_Center extends Model
{
    use HasFactory;

    // La tabla conserva el doble guion bajo definido en la migración.
    protected $table = 'training__centers';

    // Datos que los formularios pueden guardar o actualizar.
    protected $fillable = [
        'name',
        'location'
    ];

    public function areas()
    {
        // Centro que agrupa sus áreas de formación.
        return $this->hasMany(Area::class);
    }

    public function courses()
    {
        // Centro que ofrece varios cursos.
        return $this->hasMany(Course::class);
    }

    public function teachers()
    {
        // Centro al que pertenecen varios instructores.
        return $this->hasMany(Teacher::class);
    }

        //
    // Un centro de formación puede tener imágenes asociadas.
    //
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

        //
    // Imagen principal del centro de formación para mostrarla en el CRUD.
    //
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }
}
