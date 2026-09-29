<?php

use App\Http\Controllers\Api\ResourceController;
use Illuminate\Support\Facades\Route;

// Verifica que la API esté disponible y responda correctamente.
Route::get('/health', [ResourceController::class, 'health'])->name('api.health');

// Endpoints REST según el recurso solicitado: computers, areas, courses, teachers, etc.

// Las rutas del API quedan públicas durante esta etapa de consultas GET.
Route::post('/computers', [ResourceController::class, 'storeComputer'])
	->name('api.computers.store');

// GET /v1/computers -> devuelve la lista de computadores.
Route::get('/computers', [ResourceController::class, 'computers'])
	->name('api.computers');

// GET /v1/computers/{computer} -> devuelve un computador específico.
Route::get('/computers/{computer}', [ResourceController::class, 'showComputer'])
	->name('api.computers.show');

// PUT /v1/computers/{computer} -> actualiza un computador específico.
Route::put('/computers/{computer}', [ResourceController::class, 'updateComputer'])
	->name('api.computers.update');

// DELETE /v1/computers/{computer} -> elimina un computador específico.
Route::delete('/computers/{computer}', [ResourceController::class, 'destroyComputer'])
	->name('api.computers.destroy');

// POST /v1/areas -> crea una nueva área.
Route::post('/areas', [ResourceController::class, 'storeArea'])->name('api.areas.store');

// GET /v1/areas -> devuelve la lista de áreas.
Route::get('/areas', [ResourceController::class, 'areas'])->name('api.areas');

// GET /v1/areas/{area} -> devuelve un área específica.
Route::get('/areas/{area}', [ResourceController::class, 'showArea'])->name('api.areas.show');

// PUT /v1/areas/{area} -> actualiza un área específica.
Route::put('/areas/{area}', [ResourceController::class, 'updateArea'])->name('api.areas.update');

// DELETE /v1/areas/{area} -> elimina un área específica.
Route::delete('/areas/{area}', [ResourceController::class, 'destroyArea'])->name('api.areas.destroy');

// POST /v1/courses -> crea un nuevo curso.
Route::post('/courses', [ResourceController::class, 'storeCourse'])->name('api.courses.store');

// GET /v1/courses -> devuelve la lista de cursos.
Route::get('/courses', [ResourceController::class, 'courses'])->name('api.courses');

// GET /v1/courses/{course} -> devuelve un curso específico.
Route::get('/courses/{course}', [ResourceController::class, 'showCourse'])->name('api.courses.show');

// PUT /v1/courses/{course} -> actualiza un curso específico.
Route::put('/courses/{course}', [ResourceController::class, 'updateCourse'])->name('api.courses.update');

// DELETE /v1/courses/{course} -> elimina un curso específico.
Route::delete('/courses/{course}', [ResourceController::class, 'destroyCourse'])->name('api.courses.destroy');

// POST /v1/teachers -> crea un nuevo instructor.
Route::post('/teachers', [ResourceController::class, 'storeTeacher'])->name('api.teachers.store');

// GET /v1/teachers -> devuelve la lista de instructores.
Route::get('/teachers', [ResourceController::class, 'teachers'])->name('api.teachers');

// GET /v1/teachers/{teacher} -> devuelve un instructor específico.
Route::get('/teachers/{teacher}', [ResourceController::class, 'showTeacher'])->name('api.teachers.show');

// PUT /v1/teachers/{teacher} -> actualiza un instructor específico.
Route::put('/teachers/{teacher}', [ResourceController::class, 'updateTeacher'])->name('api.teachers.update');

// DELETE /v1/teachers/{teacher} -> elimina un instructor específico.
Route::delete('/teachers/{teacher}', [ResourceController::class, 'destroyTeacher'])->name('api.teachers.destroy');

// POST /v1/apprentices -> crea un nuevo aprendiz.
Route::post('/apprentices', [ResourceController::class, 'storeApprentice'])->name('api.apprentices.store');

// GET /v1/apprentices -> devuelve la lista de aprendices.
Route::get('/apprentices', [ResourceController::class, 'apprentices'])->name('api.apprentices');

// GET /v1/apprentices/{apprentice} -> devuelve un aprendiz específico.
Route::get('/apprentices/{apprentice}', [ResourceController::class, 'showApprentice'])->name('api.apprentices.show');

// PUT /v1/apprentices/{apprentice} -> actualiza un aprendiz específico.
Route::put('/apprentices/{apprentice}', [ResourceController::class, 'updateApprentice'])->name('api.apprentices.update');

// DELETE /v1/apprentices/{apprentice} -> elimina un aprendiz específico.
Route::delete('/apprentices/{apprentice}', [ResourceController::class, 'destroyApprentice'])->name('api.apprentices.destroy');

// POST /v1/training-centers -> crea un nuevo centro de formación.
Route::post('/training-centers', [ResourceController::class, 'storeTrainingCenter'])->name('api.training_centers.store');

// GET /v1/training-centers -> devuelve la lista de centros de formación.
Route::get('/training-centers', [ResourceController::class, 'trainingCenters'])->name('api.training_centers');

// GET /v1/training-centers/{trainingCenter} -> devuelve un centro específico.
Route::get('/training-centers/{trainingCenter}', [ResourceController::class, 'showTrainingCenter'])->name('api.training_centers.show');

// PUT /v1/training-centers/{trainingCenter} -> actualiza un centro específico.
Route::put('/training-centers/{trainingCenter}', [ResourceController::class, 'updateTrainingCenter'])->name('api.training_centers.update');

// DELETE /v1/training-centers/{trainingCenter} -> elimina un centro específico.
Route::delete('/training-centers/{trainingCenter}', [ResourceController::class, 'destroyTrainingCenter'])->name('api.training_centers.destroy');

// GET /v1/enrollments -> devuelve todas las inscripciones con sus relaciones.
Route::get('/enrollments', [ResourceController::class, 'enrollments'])->name('api.enrollments');

// POST /v1/enrollments -> crea una inscripción.
Route::post('/enrollments', [ResourceController::class, 'storeEnrollment'])->name('api.enrollments.store');

// GET /v1/enrollments/{enrollment} -> devuelve una inscripción específica.
Route::get('/enrollments/{enrollment}', [ResourceController::class, 'showEnrollment'])->name('api.enrollments.show');

// PUT /v1/enrollments/{enrollment} -> actualiza el estado de una inscripción.
Route::put('/enrollments/{enrollment}', [ResourceController::class, 'updateEnrollment'])->name('api.enrollments.update');

// DELETE /v1/enrollments/{enrollment} -> elimina una inscripción específica.
Route::delete('/enrollments/{enrollment}', [ResourceController::class, 'destroyEnrollment'])->name('api.enrollments.destroy');

// GET /v1/course-teachers -> devuelve las asignaciones curso-instructor.
Route::get('/course-teachers', [ResourceController::class, 'courseTeachers'])->name('api.course_teachers');

// POST /v1/course-teachers -> crea una asignación curso-instructor.
Route::post('/course-teachers', [ResourceController::class, 'storeCourseTeacher'])->name('api.course_teachers.store');

// GET /v1/course-teachers/{courseTeacher} -> devuelve una asignación específica.
Route::get('/course-teachers/{courseTeacher}', [ResourceController::class, 'showCourseTeacher'])->name('api.course_teachers.show');

// PUT /v1/course-teachers/{courseTeacher} -> actualiza una asignación.
Route::put('/course-teachers/{courseTeacher}', [ResourceController::class, 'updateCourseTeacher'])->name('api.course_teachers.update');

// DELETE /v1/course-teachers/{courseTeacher} -> elimina una asignación específica.
Route::delete('/course-teachers/{courseTeacher}', [ResourceController::class, 'destroyCourseTeacher'])->name('api.course_teachers.destroy');

// GET /v1/images -> devuelve los registros de imágenes.
Route::get('/images', [ResourceController::class, 'images'])->name('api.images');

// POST /v1/images -> registra los metadatos de una imagen.
Route::post('/images', [ResourceController::class, 'storeImage'])->name('api.images.store');

// GET /v1/images/{image} -> devuelve una imagen específica.
Route::get('/images/{image}', [ResourceController::class, 'showImage'])->name('api.images.show');

// PUT /v1/images/{image} -> actualiza los metadatos de una imagen.
Route::put('/images/{image}', [ResourceController::class, 'updateImage'])->name('api.images.update');

// DELETE /v1/images/{image} -> elimina una imagen específica.
Route::delete('/images/{image}', [ResourceController::class, 'destroyImage'])->name('api.images.destroy');

// GET /v1/summary -> devuelve un resumen general del sistema.
Route::get('/summary', [ResourceController::class, 'summary'])->name('api.summary'); 