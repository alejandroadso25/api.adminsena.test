<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;
    // Campos permitidos para registrar y actualizar aprendices.
    protected $fillable = ['name', 'email', 'cell_number', 'course_id', 'computer_id'];

    public function course()
    {
        // Curso actual del aprendiz.
        return $this->belongsTo(Course::class);
    }

    public function computer()
    {
        // Computador asignado al aprendiz.
        return $this->belongsTo(Computer::class);
    }

        //
    // Imagen principal del aprendiz para mostrarla en sus vistas administrativas.
    //
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }
}
