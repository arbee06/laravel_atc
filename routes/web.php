<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BotWaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ReportController;

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

// Route::get('/', [AuthController::class,'index']);
// Route::get('/bot/{pid?}', function ($pid=null) {
//     if(isset($pid)){
//         return "bot whatsapp for {$pid}";
//     }
//     return "bot whatsapp for all projects";
// });

Route::middleware(['auth'])->group(function(){
    Route::post('/home/import', [ImportExcelController::class,'import'])->name('import');
    Route::post('/home/sendAll', [ChatBotController::class,'sendAll'])->name('sendAll');
    Route::post('/home/sendChat', [ChatBotController::class,'sendChat'])->name('sendChat');
    Route::post('/home/sendImage', [ChatBotController::class,'sendImage'])->name('sendImage');
    Route::post('/home/sendFile', [ChatBotController::class,'sendFile'])->name('sendFile');
    Route::post('/home/sendVoice', [ChatBotController::class,'sendVoice'])->name('sendVoice');
    Route::get('/home', [ImportExcelController::class,'index'])->name('home');
    Route::get('/admin', [AdminController::class,'admin'])->name('admin');
});

Auth::routes();
Route::get('/', [HomeController::class,'index'])->name('index')->name('login');
Route::get('/logout', [HomeController::class,'logout'])->name('index')->name('logout');
Route::post('/home/per_tabular', [ReportController::class,'create_per_tabular'])->name('per_tabular');