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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResourceController extends Controller
{
    //Listar computadores con su imagen:
    public function indexComputers(): JsonResponse
    {
        return response()->json(Computer::with('image')->get());
    }
    
    //Crear computador:
    public function storeComputer(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string',
        ]);

        $computer = Computer::create($validated);
        return response()->json([
            'message' => 'Computador creado correctamente.',
            'data' => $computer,
        ], 201);
    }

    // Visualizar computador con su imagen:
    public function showComputer(Computer $computer)
    {
        return response()->json($computer->load('image'));
    }

    // Actualizar computador existente:
    public function updateComputer(Request $request, Computer $computer)
    {
        $validated = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string',
        ]);

        $computer->update($validated);

        return response()->json([
            'message' => 'Computador actualizado correctamente.',
            'data' => $computer->load('image'),
        ]);
    }

    // Eliminar computador:
    public function destroyComputer(Computer $computer)
    {
        $computer->delete();
        return response()->json([
            'message' => 'Computador eliminado correctamente.',
        ]);
    }

    // Listar todas las areas:
    public function indexAreas(): JsonResponse
    {
        return response()->json(Area::all());
    }

    // Crear area:
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

    // Visualizar área específica:
    public function showArea(Area $area)
    {
        return response()->json($area);
    }

    // Actualizar area existente:
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

    //Eliminar area:
    public function destroyArea(Area $area)
    {
        $area->delete();
        return response()->json([
            'message' => 'Área eliminada correctamente.',
        ]);
    }

    //Listar cursos:
    public function indexCourses(): JsonResponse
    {
        return response()->json(
            Course::with(['area', 'trainingCenter', 'teachers', 'images'])->get()
        );
    }

    // Crear curso con su imagen:
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

    // Visualizar curso:
    public function showCourse(Course $course)
    {
        return response()->json(
            $course->load(['area', 'trainingCenter', 'teachers', 'images'])
        );
    }

    // Actualizar curso existente:
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

    // Eliminar curso:
    public function destroyCourse(Course $course)
    {
        $course->delete();
        return response()->json([
            'message' => 'Curso eliminado correctamente.',
        ]);
    }

    // Listar instructores:
    public function indexTeachers(): JsonResponse
    {
        return response()->json(
            Teacher::with(['area', 'trainingCenter', 'courses', 'image'])->get()
        );
    }

    // Crear instructor:
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

    // Visualizar instructor:
    public function showTeacher(Teacher $teacher)
    {
        return response()->json(
            $teacher->load(['area', 'trainingCenter', 'courses', 'image'])
        );
    }

    // Actualizar instructor:
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

    // Eliminar instructor:
    public function destroyTeacher(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([
            'message' => 'Instructor eliminado correctamente.',
        ]);
    }

    // Listar aprendices con imagen:
    public function indexApprentices(): JsonResponse
    {
        return response()->json(
            Apprentice::with(['course', 'computer', 'image'])->get()
        );
    }

    // Crear aprendiz:
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

    // Visualizar aprendiz:
    public function showApprentice(Apprentice $apprentice)
    {
        return response()->json(
            $apprentice->load(['course', 'computer', 'image'])
        );
    }

    // Actualizar aprendiz:
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

    // Eliminar aprendiz:
    public function destroyApprentice(Apprentice $apprentice)
    {
        $apprentice->delete();
        return response()->json([
            'message' => 'Aprendiz eliminado correctamente.',
        ]);
    }

    // Listar centros de formación con su imagen:
    public function indexTrainingCenters(): JsonResponse
    {
        return response()->json(Training_Center::with('image')->get());
    }

    // Crear centro de formación:
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

    // Visualizar centro de formación:
    public function showTrainingCenter(Training_Center $trainingCenter)
    {
        return response()->json($trainingCenter->load('image'));
    }

    // Actualizar centro de formación existente:
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

    // Eliminar centro de formación:
    public function destroyTrainingCenter(Training_Center $trainingCenter)
    {
        $trainingCenter->delete();
        return response()->json([
            'message' => 'Centro de formación eliminado correctamente.',
        ]);
    }

    // Listar asignaciones curso-instructor: 
    public function indexCourseTeachers(): JsonResponse
    {
        return response()->json(
            Course_Teacher::with(['course', 'teacher'])->get()
        );
    }

    // Crear asignación curso-instructor:
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

    // Visualizar asignación curso-instructor:
    public function showCourseTeacher(Course_Teacher $courseTeacher)
    {
        return response()->json(
            $courseTeacher->load(['course', 'teacher'])
        );
    }

    // Actualizar asignación curso-instructor existente:
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

    // Eliminar asignación curso-instructor:
    public function destroyCourseTeacher(Course_Teacher $courseTeacher)
    {
        $courseTeacher->delete();
        return response()->json([
            'message' => 'Asignación eliminada correctamente.',
        ]);
    }

    // Listar imágenes:
    public function indexImages(): JsonResponse
    {
        return response()->json(Image::all());
    }

    // Crear imagen:
    public function storeImage(Request $request)
    {
        // Valida que la entidad asociada exista y esté permitida.
        $imageable = $this->validateImageOwner($request);

        // Valida el archivo y los metadatos opcionales.
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'alt_text' => 'nullable|string',
            'is_primary' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Guarda el archivo en storage/app/public/images.
        $file = $request->file('image');
        $path = $file->store('images', 'public');

        // Informa si Laravel no pudo guardar el archivo.
        if (!$path) {
            return response()->json([
                'message' => 'No se pudo guardar la imagen.',
            ], 500);
        }

        // Obtiene el nombre original del archivo subido.
        $originalName = $file->getClientOriginalName();

        // Guarda la ruta y los metadatos en la tabla images.
        $image = Image::create($imageable + [
            'path' => $path,
            'file_name' => basename($path),
            'original_name' => $originalName,
            'alt_text' => $validated['alt_text'] ?? null,
            'is_primary' => $validated['is_primary'] ?? false,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        // Devuelve el registro creado con código HTTP 201.
        return response()->json([
            'message' => 'Imagen guardada correctamente.',
            'data' => $image,
        ], 201);
    }

    // Visualizar imagen:
    public function showImage(Image $image)
    {
        return response()->json($image);
    }

    // Actualizar imagen existente:
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

    // Eliminar registro de imagen:
    public function destroyImage(Image $image)
    {
        $image->delete();

        return response()->json([
            'message' => 'Imagen eliminada correctamente.',
        ]);
    }

    // Validar que la imagen perternezca a la entidad correspondiente:
    private function validateImageOwner(Request $request): array
    {
        $imageableTables = [
            Computer::class => 'computers',
            Course::class => 'courses',
            Teacher::class => 'teachers',
            Apprentice::class => 'apprentices',
            Training_Center::class => 'training__centers',
        ];

        // Valida que el tipo de entidad sea uno de los permitidos:
        $owner = $request->validate([
            'imageable_type' => ['required', 'string', Rule::in(array_keys($imageableTables))],
        ]);

        // Comprueba que el ID exista en la tabla correspondiente al modelo validado:
        return $owner + $request->validate([
            'imageable_id' => [
                'required',
                'integer',
                Rule::exists($imageableTables[$owner['imageable_type']], 'id'),
            ],
        ]);
    }
}