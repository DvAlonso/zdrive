<?php

use App\Models\Folder;
use Illuminate\Support\Facades\Route;

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

Route::get('/drive', function () {
    return view('app.drive');
})->name('drive');

Route::get('/drive/folders/{folder}', function (Folder $folder){
    return view('app.drive')->with('folder', $folder);
})->name('drive.folder');
