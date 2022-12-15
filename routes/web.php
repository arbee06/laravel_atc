<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BotWaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\QmliController;

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
    Route::post('/bot_by_import/import', [ImportExcelController::class,'import'])->name('import');
    Route::post('/bot_by_import/remindAll', [ChatBotController::class,'remindAll'])->name('remindAll');
    Route::post('/bot_by_import/prologueAll', [ChatBotController::class,'prologueAll'])->name('prologueAll');
    Route::post('/bot_by_import/sendChat', [ChatBotController::class,'sendChat'])->name('sendChat');
    Route::post('/bot_by_import/prologueChat', [ChatBotController::class,'prologueChat'])->name('prologueChat');
    Route::post('/bot_by_import/sendImage', [ChatBotController::class,'sendImage'])->name('sendImage');
    Route::post('/bot_by_import/sendFile', [ChatBotController::class,'sendFile'])->name('sendFile');
    Route::post('/bot_by_import/sendVoice', [ChatBotController::class,'sendVoice'])->name('sendVoice');
    Route::post('/bot_by_import/per_tabular', [ReportController::class,'create_per_tabular'])->name('per_tabular');
    Route::get('/bot_by_import', [ImportExcelController::class,'index'])->name('bot_by_import');
    Route::get('/bot_by_qmli', [QmliController::class,'index'])->name('bot_by_qmli');
    Route::get('/livewire_qmli', \App\Http\Livewire\ChatBotLivewire::class)->name('livewire_qmli');
    Route::get('/admin', [AdminController::class,'admin'])->name('admin');


});

Auth::routes();
Route::get('/', [HomeController::class,'index'])->name('index')->name('login');
Route::get('/logout', [HomeController::class,'logout'])->name('index')->name('logout');
