<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    // Campos permitidos para crear una inscripción.
    protected $fillable = ['user_id', 'course_id', 'status'];

    // Usuario que envió la inscripción.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Curso seleccionado para la inscripción.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}