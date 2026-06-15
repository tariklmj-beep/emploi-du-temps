<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin,professeur'])
    ->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

$profilePath = '/profile';

Route::middleware('auth')->group(function () use ($profilePath) {
    Route::get($profilePath, [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch($profilePath, [ProfileController::class, 'update'])->name('profile.update');
    Route::delete($profilePath, [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routes for CRUD operations
Route::middleware(['auth'])->group(function () {
    Route::get('emplois-du-temps/export/pdf', [EmploiDuTempsController::class, 'exportPdf'])
        ->name('emplois-du-temps.export.pdf');

    Route::resource('emplois-du-temps', EmploiDuTempsController::class)
        ->only(['index', 'show'])
        ->whereNumber('emplois_du_temp');
});

Route::middleware(['auth', 'role:admin,professeur'])->group(function () {
    Route::post('emplois-du-temps/generation-auto', [EmploiDuTempsController::class, 'autoGenerate'])
        ->name('emplois-du-temps.generate-auto');
    Route::resource('emplois-du-temps', EmploiDuTempsController::class)
        ->except(['index', 'show'])
        ->whereNumber('emplois_du_temp');
    Route::resource('notes', NoteController::class);
    Route::resource('absences', AbsenceController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('filieres', FiliereController::class);
    Route::resource('matieres', MatiereController::class);
    Route::resource('enseignants', EnseignantController::class);
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('salles', SalleController::class);
});

require __DIR__.'/auth.php';
