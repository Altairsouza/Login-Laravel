<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
use App\Mail\EmailTeste;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', [Main::class, 'index'])->name('index');
Route::get('/login', [Main::class, 'login'])->name('login');
Route::post('/login_submit', [Main::class, 'login_submit'])->name('login_submit');


Route::get('home', [Main::class, 'home'])->name('home');
Route::get('/logout', [Main::class, 'logout'])->name('logout');



//===========================================================
// route para enviar email
Route::get('/aaa', function () {

    Mail::to('ramon.kof@hotmail.com')->send(new EmailTeste());
    echo 'email enviado';
});
//=============================================================




Route::get('/edit/{id_usuario}', [Main::class,'edit'])->name('main_edit');

Route::get('/final/{hash}', [Main::class, 'final'])->name('main_final');


Route::get('/edite/{id_usuario}', [Main::class, 'edite'])->name('main_edite');



//upload de ficheiros
Route::post('/upload', [Main::class,'upload'])->name('main_upload');



// download de um ficheiro  1º vou listar e o segundo é download
Route::get('/lista_ficheiros', [Main::class,'lista_ficheiros'])->name('main_lista_ficheiros');
Route::get('/download/{file}', [Main::class,'download'])->name('main_download');

