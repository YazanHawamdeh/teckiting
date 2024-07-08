<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
use App\Http\Controllers\NormalUser;

use App\Http\Controllers\Types;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [Home::class, 'index'])->middleware(['auth', 'verified'])->name('index');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::post('/add_teckit', [Admin::class, 'store'])->name('add_teckit');
Route::get('/view_teckit', [Admin::class, 'create'])->name('view_teckit');

route::post('/add_type', [Admin::class, 'add_type']);
route::get('/view_type', [Admin::class, 'view_type']);


Route::get('/view_users', [Admin::class, 'view_users'])->name('view_users');
route::get('/delete_user/{id}', [Admin::class, 'delete_User']);
route::get('/update_user/{id}', [Admin::class, 'update_user']);
route::post('/update_user_confirm/{id}', [Admin::class, 'update_user_confirm']);

Route::get('/view_teckits', [Admin::class, 'view_teckits'])->name('view_teckits');



route::get('/onWorkTeckit', [Home::class, 'onWorkTeckit']);
route::get('/canceledRejected', [Home::class, 'cancelAndRejectTeckits']);
route::get('/DoneTeckits', [Home::class, 'DoneTeckits']);




route::get('/teckit_details/{id}', [Home::class, 'teckit_details']);
route::get('/teckitDetailsSolved/{id}', [Home::class, 'teckitDetailsSolved']);
route::get('/rejectedTeckitsDetails/{id}', [Home::class, 'rejectedTeckitsDetails']);
// route::get('/completedTeckitDetails/{id}', [Home::class, 'completedTeckitDetails']);

route::get('/teckit_details_user/{id}', [Normaluser::class, 'teckit_details_user']);
route::get('/rejectedTeckitsDetailsUser/{id}', [Normaluser::class, 'rejectedTeckitsDetailsUser']);
route::get('/completedTeckitDetailsUser/{id}', [Normaluser::class, 'completedTeckitDetailsUser']);

route::get('/upload', [NormalUser::class, 'viewUpload']);




Route::post('/submit-solution', [Home::class, 'submitSolution'])->name('submit.solution');


// In web.php
Route::post('/submit-rejected', [Home::class, 'submitRejected'])->name('submit-rejected');

Route::post('/teckit/accept/{id}', [Home::class, 'acceptTeckit'])->name('teckit.accept');
Route::post('/teckit/reject/{id}', [Home::class, 'rejectTeckit'])->name('teckit.reject');
Route::post('/teckit/complete/{id}', [Home::class, 'completeTeckit'])->name('teckit.complete');


// Route::get('/', [Home::class, 'index'])->name('index');


// route::get('/profileUserTeckit', function() {
//     return view('home.profileUserTeckit');
// })->name('profileUserTeckit');;

// route::Controller(PostController::class)->group(function() {
//     route::get('/','index');
//     route::get('types','getTypes')->name('getTypes');

// });


require __DIR__.'/auth.php';

Route::view('/profileUserTeckit', 'home.profileUserTeckit', ['name' => 'profileUserTeckit'])->name('profileUserTeckit');

Route::post('/updateStatus', [Home::class, 'updateStatus']);


