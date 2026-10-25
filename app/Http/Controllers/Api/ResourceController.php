<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apprentice;
use App\Models\Area;
use App\Models\Computer;
use App\Models\Course;
use App\Models\Course_Teacher;
use App\Models\Image;
use App\Models\Teacher;
use App\Models\Training_Center;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResourceController extends Controller
{
    public function storeComputer(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|integer',
        ]);

        $computer = Computer::create($validated);
        return response()->json([
            'message' => 'Computador creado correctamente.',
            'data' => $computer,
        ], 201);
    }

    /**
     * Devuelve todos los computadores registrados.
     */
    public function computers()
    {
        return response()->json(
            Computer::with('image')->get()
        );
    }

    // Devuelve un computador específico con su imagen principal.
    public function showComputer(Computer $computer)
    {
        return response()->json($computer->load('image'));
    }

    // Actualiza todos los datos de un computador existente.
    public function updateComputer(Request $request, Computer $computer)
    {
        $validated = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|integer',
        ]);

        $computer->update($validated);

        return response()->json([
            'message' => 'Computador actualizado correctamente.',
            'data' => $computer->load('image'),
        ]);
    }

    // Elimina un computador existente; sus aprendices conservan el registro según la FK configurada.
    public function destroyComputer(Computer $computer)
    {
        $computer->delete();
        return response()->json([
            'message' => 'Computador eliminado correctamente.',
        ]);
    }

    /**
     * Crea una nueva área a partir de una petición POST.
     */
    public function storeArea(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $area = Area::create($validated);

        return response()->json([
            'message' => 'Área creada correctamente.',
            'data' => $area,
        ], 201);
    }

    /**
     * Devuelve todas las áreas registradas.
     */
    public function areas()
    {
        return response()->json(
            Area::all()
        );
    }

    // Devuelve un área específica.
    public function showArea(Area $area)
    {
        return response()->json($area);
    }

    // Actualiza el nombre de un área existente.
    public function updateArea(Request $request, Area $area)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $area->update($validated);
        return response()->json([
            'message' => 'Área actualizada correctamente.',
            'data' => $area,
        ]);
    }

    // Elimina un área existente.
    public function destroyArea(Area $area)
    {
        $area->delete();
        return response()->json([
            'message' => 'Área eliminada correctamente.',
        ]);
    }

    /**
     * Crea un nuevo curso a partir de una petición POST.
     */
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'course_number' => 'required|integer',
            'day' => 'required|string',
            'area_id' => 'nullable|integer|exists:areas,id',
            'training_center_id' => 'nullable|integer|exists:training__centers,id',
        ]);

        $course = Course::create($validated);
        return response()->json([
            'message' => 'Curso creado correctamente.',
            'data' => $course->load(['area', 'trainingCenter', 'teachers', 'images']),
        ], 201);
    }

    /**
     * Devuelve todos los cursos con sus relaciones.
     */
    public function courses()
    {
        return response()->json(
            Course::with(['area', 'trainingCenter', 'teachers', 'images'])->get()
        );
    }

    // Devuelve un curso específico con sus relaciones principales.
    public function showCourse(Course $course)
    {
        return response()->json(
            $course->load(['area', 'trainingCenter', 'teachers', 'images'])
        );
    }

    // Actualiza todos los datos de un curso existente.
    public function updateCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_number' => 'required|integer',
            'day' => 'required|string',
            'area_id' => 'nullable|integer|exists:areas,id',
            'training_center_id' => 'nullable|integer|exists:training__centers,id',
        ]);

        $course->update($validated);

        return response()->json([
            'message' => 'Curso actualizado correctamente.',
            'data' => $course->load(['area', 'trainingCenter', 'teachers', 'images']),
        ]);
    }

    // Elimina un curso existente junto con las relaciones configuradas por la base de datos.
    public function destroyCourse(Course $course)
    {
        $course->delete();
        return response()->json([
            'message' => 'Curso eliminado correctamente.',
        ]);
    }

    /**
     * Crea un nuevo instructor a partir de una petición POST.
     */
    public function storeTeacher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:teachers,email',
            'area_id' => 'nullable|integer|exists:areas,id',
            'training_center_id' => 'nullable|integer|exists:training__centers,id',
        ]);

        $teacher = Teacher::create($validated);

        return response()->json([
            'message' => 'Instructor creado correctamente.',
            'data' => $teacher->load(['area', 'trainingCenter', 'courses', 'image']),
        ], 201);
    }

    /**
     * Devuelve todos los instructores con sus relaciones.
     */
    public function teachers()
    {
        return response()->json(
            Teacher::with(['area', 'trainingCenter', 'courses', 'image'])->get()
        );
    }

    // Devuelve un instructor específico con su área, centro e imagen.
    public function showTeacher(Teacher $teacher)
    {
        return response()->json(
            $teacher->load(['area', 'trainingCenter', 'courses', 'image'])
        );
    }

    // Actualiza los datos de un instructor sin invalidar su propio correo.
    public function updateTeacher(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers', 'email')->ignore($teacher->id),
            ],
            'area_id' => 'nullable|integer|exists:areas,id',
            'training_center_id' => 'nullable|integer|exists:training__centers,id',
        ]);

        $teacher->update($validated);

        return response()->json([
            'message' => 'Instructor actualizado correctamente.',
            'data' => $teacher->load(['area', 'trainingCenter', 'courses', 'image']),
        ]);
    }

    // Elimina un instructor existente junto con sus asignaciones relacionadas.
    public function destroyTeacher(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([
            'message' => 'Instructor eliminado correctamente.',
        ]);
    }

    /**
     * Crea un nuevo aprendiz a partir de una petición POST.
     */
    public function storeApprentice(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:apprentices,email',
            'cell_number' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
            'computer_id' => 'nullable|integer|exists:computers,id',
        ]);

        $apprentice = Apprentice::create($validated);

        return response()->json([
            'message' => 'Aprendiz creado correctamente.',
            'data' => $apprentice,
        ], 201);
    }

    /**
     * Devuelve todos los aprendices con sus relaciones.
     */
    public function apprentices()
    {
        return response()->json(
            Apprentice::with(['course', 'computer', 'image'])->get()
        );
    }

    // Devuelve un aprendiz específico con su curso, computador e imagen.
    public function showApprentice(Apprentice $apprentice)
    {
        return response()->json(
            $apprentice->load(['course', 'computer', 'image'])
        );
    }

    // Actualiza los datos de un aprendiz sin invalidar su propio correo.
    public function updateApprentice(Request $request, Apprentice $apprentice)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('apprentices', 'email')->ignore($apprentice->id),
            ],
            'cell_number' => 'required|string',
            'course_id' => 'required|integer|exists:courses,id',
            'computer_id' => 'nullable|integer|exists:computers,id',
        ]);

        $apprentice->update($validated);
        return response()->json([
            'message' => 'Aprendiz actualizado correctamente.',
            'data' => $apprentice->load(['course', 'computer', 'image']),
        ]);
    }

    // Elimina un aprendiz existente.
    public function destroyApprentice(Apprentice $apprentice)
    {
        $apprentice->delete();
        return response()->json([
            'message' => 'Aprendiz eliminado correctamente.',
        ]);
    }

    /**
     * Crea un nuevo centro de formación a partir de una petición POST.
     */
    public function storeTrainingCenter(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $trainingCenter = Training_Center::create($validated);
        return response()->json([
            'message' => 'Centro de formación creado correctamente.',
            'data' => $trainingCenter,
        ], 201);
    }

    /**
     * Devuelve todos los centros de formación con sus relaciones.
     */
    public function trainingCenters()
    {
        return response()->json(
            Training_Center::with('image')->get()
        );
    }

    // Devuelve un centro de formación específico con su imagen principal.
    public function showTrainingCenter(Training_Center $trainingCenter)
    {
        return response()->json($trainingCenter->load('image'));
    }

    // Actualiza los datos de un centro de formación existente.
    public function updateTrainingCenter(Request $request, Training_Center $trainingCenter)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $trainingCenter->update($validated);
        return response()->json([
            'message' => 'Centro de formación actualizado correctamente.',
            'data' => $trainingCenter->load('image'),
        ]);
    }

    // Elimina un centro de formación existente.
    public function destroyTrainingCenter(Training_Center $trainingCenter)
    {
        $trainingCenter->delete();
        return response()->json([
            'message' => 'Centro de formación eliminado correctamente.',
        ]);
    }

    // Devuelve todas las asignaciones entre cursos e instructores.
    public function courseTeachers()
    {
        return response()->json(
            Course_Teacher::with(['course', 'teacher'])->get()
        );
    }

    // Crea una asignación entre un curso y un instructor existentes.
    public function storeCourseTeacher(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
                Rule::unique('course__teachers', 'teacher_id')
                    ->where('course_id', $request->input('course_id')),
            ],
        ]);

        $courseTeacher = Course_Teacher::create($validated);

        return response()->json([
            'message' => 'Asignación creada correctamente.',
            'data' => $courseTeacher->load(['course', 'teacher']),
        ], 201);
    }

    // Devuelve una asignación curso-instructor específica.
    public function showCourseTeacher(Course_Teacher $courseTeacher)
    {
        return response()->json(
            $courseTeacher->load(['course', 'teacher'])
        );
    }

    // Actualiza una asignación curso-instructor existente.
    public function updateCourseTeacher(Request $request, Course_Teacher $courseTeacher)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'teacher_id' => [
                'required',
                'integer',
                'exists:teachers,id',
                Rule::unique('course__teachers', 'teacher_id')
                    ->where('course_id', $request->input('course_id'))
                    ->ignore($courseTeacher->id),
            ],
        ]);

        $courseTeacher->update($validated);

        return response()->json([
            'message' => 'Asignación actualizada correctamente.',
            'data' => $courseTeacher->load(['course', 'teacher']),
        ]);
    }

    // Elimina una asignación curso-instructor existente.
    public function destroyCourseTeacher(Course_Teacher $courseTeacher)
    {
        $courseTeacher->delete();

        return response()->json([
            'message' => 'Asignación eliminada correctamente.',
        ]);
    }

    // Devuelve los metadatos registrados de todas las imágenes.
    public function images()
    {
        return response()->json(Image::all());
    }

    // Registra los metadatos de una imagen almacenada previamente.
    public function storeImage(Request $request)
    {
        $validated = $this->validateImageOwner($request) + $request->validate([
            'path' => 'required|string',
            'file_name' => 'required|string',
            'original_name' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'is_primary' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $image = Image::create($validated);
        return response()->json([
            'message' => 'Imagen registrada correctamente.',
            'data' => $image,
        ], 201);
    }

    // Devuelve los metadatos de una imagen específica.
    public function showImage(Image $image)
    {
        return response()->json($image);
    }

    // Actualiza los metadatos de una imagen existente.
    public function updateImage(Request $request, Image $image)
    {
        $validated = $this->validateImageOwner($request) + $request->validate([
            'path' => 'required|string',
            'file_name' => 'required|string',
            'original_name' => 'nullable|string',
            'alt_text' => 'nullable|string',
            'is_primary' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $image->update($validated);
        return response()->json([
            'message' => 'Imagen actualizada correctamente.',
            'data' => $image,
        ]);
    }

    // Elimina el registro de una imagen; no borra automáticamente el archivo físico.
    public function destroyImage(Image $image)
    {
        $image->delete();

        return response()->json([
            'message' => 'Imagen eliminada correctamente.',
        ]);
    }

    /**
     * Valida el tipo de entidad de la imagen y que su registro exista.
     */
    private function validateImageOwner(Request $request): array
    {
        $imageableTables = [
            Computer::class => 'computers',
            Course::class => 'courses',
            Teacher::class => 'teachers',
            Apprentice::class => 'apprentices',
            Training_Center::class => 'training__centers',
        ];

        // Acepta únicamente los modelos incluidos en el mapa de entidades con imágenes.
        $owner = $request->validate([
            'imageable_type' => ['required', 'string', Rule::in(array_keys($imageableTables))],
        ]);

        // Comprueba que el ID exista en la tabla correspondiente al modelo validado.
        return $owner + $request->validate([
            'imageable_id' => [
                'required',
                'integer',
                Rule::exists($imageableTables[$owner['imageable_type']], 'id'),
            ],
        ]);
    }
}
