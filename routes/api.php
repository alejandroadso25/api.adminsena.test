<?php

use App\Http\Controllers\Api\ResourceController;
use Illuminate\Support\Facades\Route;

// CRUD de computadores: index, store, show, update y destroy.
Route::get('/computers', [ResourceController::class, 'indexComputers'])
    ->name('api.computers');
Route::post('/computers', [ResourceController::class, 'storeComputer'])
    ->name('api.computers.store');
Route::get('/computers/{computer}', [ResourceController::class, 'showComputer'])
    ->name('api.computers.show');
Route::put('/computers/{computer}', [ResourceController::class, 'updateComputer'])
    ->name('api.computers.update');
Route::delete('/computers/{computer}', [ResourceController::class, 'destroyComputer'])
    ->name('api.computers.destroy');

// CRUD de áreas: index, store, show, update y destroy.
Route::get('/areas', [ResourceController::class, 'indexAreas'])
    ->name('api.areas');
Route::post('/areas', [ResourceController::class, 'storeArea'])
    ->name('api.areas.store');
Route::get('/areas/{area}', [ResourceController::class, 'showArea'])
    ->name('api.areas.show');
Route::put('/areas/{area}', [ResourceController::class, 'updateArea'])
    ->name('api.areas.update');
Route::delete('/areas/{area}', [ResourceController::class, 'destroyArea'])
    ->name('api.areas.destroy');

// CRUD de cursos: index, store, show, update y destroy.
Route::get('/courses', [ResourceController::class, 'indexCourses'])
    ->name('api.courses');
Route::post('/courses', [ResourceController::class, 'storeCourse'])
    ->name('api.courses.store');
Route::get('/courses/{course}', [ResourceController::class, 'showCourse'])
    ->name('api.courses.show');
Route::put('/courses/{course}', [ResourceController::class, 'updateCourse'])
    ->name('api.courses.update');
Route::delete('/courses/{course}', [ResourceController::class, 'destroyCourse'])
    ->name('api.courses.destroy');

// CRUD de instructores: index, store, show, update y destroy.
Route::get('/teachers', [ResourceController::class, 'indexTeachers'])
    ->name('api.teachers');
Route::post('/teachers', [ResourceController::class, 'storeTeacher'])
    ->name('api.teachers.store');
Route::get('/teachers/{teacher}', [ResourceController::class, 'showTeacher'])
    ->name('api.teachers.show');
Route::put('/teachers/{teacher}', [ResourceController::class, 'updateTeacher'])
    ->name('api.teachers.update');
Route::delete('/teachers/{teacher}', [ResourceController::class, 'destroyTeacher'])
    ->name('api.teachers.destroy');

// CRUD de aprendices: index, store, show, update y destroy.
Route::get('/apprentices', [ResourceController::class, 'indexApprentices'])
    ->name('api.apprentices');
Route::post('/apprentices', [ResourceController::class, 'storeApprentice'])
    ->name('api.apprentices.store');
Route::get('/apprentices/{apprentice}', [ResourceController::class, 'showApprentice'])
    ->name('api.apprentices.show');
Route::put('/apprentices/{apprentice}', [ResourceController::class, 'updateApprentice'])
    ->name('api.apprentices.update');
Route::delete('/apprentices/{apprentice}', [ResourceController::class, 'destroyApprentice'])
    ->name('api.apprentices.destroy');

// CRUD de centros de formación: index, store, show, update y destroy.
Route::get('/training-centers', [ResourceController::class, 'indexTrainingCenters'])
    ->name('api.training_centers');
Route::post('/training-centers', [ResourceController::class, 'storeTrainingCenter'])
    ->name('api.training_centers.store');
Route::get('/training-centers/{trainingCenter}', [ResourceController::class, 'showTrainingCenter'])
    ->name('api.training_centers.show');
Route::put('/training-centers/{trainingCenter}', [ResourceController::class, 'updateTrainingCenter'])
    ->name('api.training_centers.update');
Route::delete('/training-centers/{trainingCenter}', [ResourceController::class, 'destroyTrainingCenter'])
    ->name('api.training_centers.destroy');

// CRUD de la tabla pivote course__teachers: index, store, show, update y destroy.
Route::get('/course-teachers', [ResourceController::class, 'indexCourseTeachers'])
    ->name('api.course_teachers');
Route::post('/course-teachers', [ResourceController::class, 'storeCourseTeacher'])
    ->name('api.course_teachers.store');
Route::get('/course-teachers/{courseTeacher}', [ResourceController::class, 'showCourseTeacher'])
    ->name('api.course_teachers.show');
Route::put('/course-teachers/{courseTeacher}', [ResourceController::class, 'updateCourseTeacher'])
    ->name('api.course_teachers.update');
Route::delete('/course-teachers/{courseTeacher}', [ResourceController::class, 'destroyCourseTeacher'])
    ->name('api.course_teachers.destroy');

// CRUD de metadatos de imágenes: index, store, show, update y destroy.
Route::get('/images', [ResourceController::class, 'indexImages'])
    ->name('api.images');
Route::post('/images', [ResourceController::class, 'storeImage'])
    ->name('api.images.store');
Route::get('/images/{image}', [ResourceController::class, 'showImage'])
    ->name('api.images.show');
Route::put('/images/{image}', [ResourceController::class, 'updateImage'])
    ->name('api.images.update');
Route::delete('/images/{image}', [ResourceController::class, 'destroyImage'])
    ->name('api.images.destroy');
