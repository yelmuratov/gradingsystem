<?php
    use App\Routes\Route;
    use App\Controllers\CategoryController;

    Route::get('/',[CategoryController::class,'index']);

    // Students
    Route::get('/students',[CategoryController::class,'students']);
    Route::get('/student_create',[CategoryController::class,'student_create']);
    Route::get('/edit_st',[CategoryController::class,'edit_student']);
    Route::post('/update_st',[CategoryController::class,'update_student']);
    Route::post('/create_st',[CategoryController::class,'save_student']);
    Route::get('/delete_st',[CategoryController::class,'delete_student']);

    // Subjects
    Route::get('/subjects',[CategoryController::class,'subjects']);
    Route::get('/subject_create',[CategoryController::class,'subject_create']);
    Route::get('/edit_sub',[CategoryController::class,'edit_subject']);
    Route::post('/create_sub',[CategoryController::class,'save_subject']);
    Route::get('/delete_sub',[CategoryController::class,'delete_subject']);
    Route::post('/update_sub',[CategoryController::class,'update_subject']);

    // Exams
    Route::get('/exams',[CategoryController::class,'exams']);
    Route::post('/create_ex',[CategoryController::class,'exam_create']);

    // Results
    Route::get('/results',[CategoryController::class,'results']);
?>