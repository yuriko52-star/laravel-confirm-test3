<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;

// use Laravel\Fortify\Fortify;



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
/*Fortify::loginView(function () {
    return view('auth.login');
});
Route::get('/login',function() {
    return view('auth.login');
})->name('login');
Route::get('/register/step1', [WeightLogController::class, 'showStep1'])->name('register.step1');
Route::post('/register/step2', [WeightLogController::class, 'showStep2'])->name('register.step2');
Route::post('/register/complete', [WeightLogController::class, 'registerComplete'])->name('register.complete');
*/
/*Route::prefix('register')->group(function () {
    Route::get('/step1', [WeightLogController::class, 'showStep1'])->name('register.step1.get');
    Route::post('/step1', [WeightLogController::class, 'processStep1'])->name('register.step1.post');

    Route::get('/step2', [WeightLogController::class, 'showStep2'])->name('register.step2.get');
        // これでだめなら一時的に GET ルートを許可して問題を特定（'processStep2'）
       
    Route::post('/step2', [WeightLogController::class, 'processStep2'])->name('register.step2.post');
});
*/
 Route::get('/weight_logs',[WeightLogController::class,'index'])->name('weight_logs.index');

Route::get('/weight_logs/search',[WeightLogController::class,'search']);
Route::get('/weight_logs/create',[WeightLogController::class,'create'])->name('weight_logs.create');
Route::post('/weight_logs/create',[WeightLogController::class,'store'])->name('weight_logs.store');

Route::match(['get','post'],'/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->name('goal.setting');

Route::get('/weight_logs/{weightLogId}',[WeightLogController::class,'show'])->name('weight_logs.show');
Route::put('/weight_logs/{weightLogId}/update',[WeightLogController::class,'update'])->name('weight_logs.update');
Route::delete('/weight_logs/{weightLogId}/delete',[WeightLogController::class,'destroy'])->name('weight_logs.delete');

  

