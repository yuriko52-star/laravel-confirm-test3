<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeightLogController;


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
Route::get('/weight_logs',[WeightLogController::class,'index'])->name('weight_logs.index');
// あとでweight_logsに戻す
Route::get('/weight_logs/search',[WeightLogController::class,'search']);
Route::get('/weight_logs/create',[WeightLogController::class,'create'])->name('weight_logs.create');
Route::post('/weight_logs/create',[WeightLogController::class,'store'])->name('weight_logs.store');

Route::get('/weight_logs/{weightLogId}',[WeightLogController::class,'show'])->name('weight_logs.show');
Route::put('/weight_logs/{weightLogId}/update',[WeightLogController::class,'update'])->name('weight_logs.update');
Route::delete('/weight_logs/{weightLogId}/delete',[WeightLogController::class,'destroy'])->name('weight_logs.delete');
