<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WeightTargetController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('welcome');
 });
// Fortify::loginView(function () {
    // return view('auth.login');
// });
Route::get('/login',function() {
    return view('auth.login');
})->name('login');



// Step1: ユーザー情報入力
Route::get('/register/step1', [RegistrationController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step1', [RegistrationController::class, 'processStep1'])->name('register.step1.process');

// Step2: 初期体重・目標体重入力
Route::get('/register/step2', [RegistrationController::class, 'showStep2'])->name('register.step2');
Route::post('/register/step2', [RegistrationController::class, 'processStep2'])->name('register.step2.process');


Route::middleware(['auth'])->group(function () {
    

 Route::get('/weight_logs',[WeightLogController::class,'index'])->name('weight_logs.index');

Route::get('/weight_logs/search',[WeightLogController::class,'search']);
Route::get('/weight_logs/create',[WeightLogController::class,'create'])->name('weight_logs.create');
Route::post('/weight_logs/create',[WeightLogController::class,'store'])->name('weight_logs.store');


Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'showGoalSettingForm'])->name('goal.setting.form');
Route::post('/weight_logs/goal_setting', [WeightTargetController::class, 'goalSetting'])->name('goal.setting');


Route::get('/weight_logs/{weightLogId}',[WeightLogController::class,'show'])->name('weight_logs.show');
Route::put('/weight_logs/{weightLogId}/update',[WeightLogController::class,'update'])->name('weight_logs.update');
Route::delete('/weight_logs/{weightLogId}/delete',[WeightLogController::class,'destroy'])->name('weight_logs.delete');
});


