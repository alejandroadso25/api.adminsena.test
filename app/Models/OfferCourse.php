<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCourse extends Model
{
    use HasFactory;

    // Campos permitidos al crear o actualizar una convocatoria.
    protected $fillable = [
        'course_id',
        'program_name',
        'training_type',
        'location',
        'is_open',
        'description',
        'duration',
        'capacity',
    ];

    // La base de datos almacena el estado como booleano.
    protected $casts = [
        'is_open' => 'boolean',
    ];

    // Curso base al que pertenece esta convocatoria.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}