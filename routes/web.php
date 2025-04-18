<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use  App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;


// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'updateEmailAndPassword'])->name('profile.update');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');
        Route::post('/cohort/Add_Cohort', [CohortController::class, 'Add_Cohort'])->name('cohort.Add_Cohort');
        Route::post('/cohort/update/{id}', [CohortController::class, 'UpdateCohort'])->name('Cohort.update');
        Route::delete('cohort/delete/{id}', [CohortController::class, 'delete_cohort'])->name('Cohort.delete');
        Route::post('/cohorts/{cohort}/attach-student', [CohortController::class, 'attachStudentToCohort'])->name('cohorts.attach-student');


        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teachers/save', [TeacherController::class, 'Save_Teacher'])->name('teacher.save');
        Route::post('/teachers/update', [TeacherController::class, 'UpdateUser'])->name('teacher.update');
        Route::delete('teachers/delete/{id}', [TeacherController::class, 'delete'])->name('teacher.delete');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');
        Route::post('/student/save', [StudentController::class, 'Save_students'])->name('student.save');
        Route::post('/students/update', [StudentController::class, 'UpdateUser'])->name('student.update');
        Route::delete('students/delete/{id}', [StudentController::class, 'delete'])->name('student.delete');






        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');


        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');
        Route::post('/retrospectives/save', [RetroController::class, 'saveRetro'])->name('retro.save');

        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
        Route::post('/common-life/save', [\App\Http\Controllers\CommonLifeController::class, 'saveTask'])->name('commonlife.save');

        //Email
        Route::post('/send-mail', [\App\Http\Controllers\EmailController::class, 'sendWelcomeEmail'])->name('sendmail');

    });


});

require __DIR__.'/auth.php';
