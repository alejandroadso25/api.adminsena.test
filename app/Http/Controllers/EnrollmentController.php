<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Registra una inscripción para el usuario autenticado.
     */
    public function store(Request $request, Course $course)
    {
        // auth garantiza que solo una cuenta pueda enviar esta solicitud.
        $user = $request->user();

        // Mantiene cerradas las convocatorias pares aunque se intente usar la ruta directamente.
        $programs = [
            'ADSO', 'Sistemas', 'Animación 3D', 'Mecatrónica', 'Barismo',
            'Cocina', 'Enfermería', 'Actividad Física', 'Ebanistería',
            'Gestión Administrativa',
        ];
        $position = array_search($course->course_number, $programs, true);

        if ($position === false || $position % 2 !== 0) {
            return back()->with('status', 'Esta convocatoria no está abierta.');
        }

        // Evita duplicar la inscripción del mismo usuario en el mismo curso.
        if (Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return back()->with('status', 'Ya estás inscrito en este programa.');
        }

        // Crea la solicitud para que posteriormente pueda ser revisada.
        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'pendiente',
        ]);

        return back()->with('status', 'Inscripción realizada correctamente.');
    }
}