<?php

use App\Http\Controllers\Controller;
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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/',[Controller::class,'frniture'])->name('Index');
Route::get('ClassFur',[Controller::class,'GetClassified'])->name('ClassFur');

Route::get('/bedRoom',[Controller::class,'bedRooms'])->name('bed_rooms');

Route::get('/livingRoom',[Controller::class,'livingRoom'])->name('living_room');


Route::view('about_us', 'about')->name('about_us');
Route::view('account', 'account')->name('account');

Route::get('design_room',[Controller::class,'designRoom'])->name('design_room');

Route::get('get_kind',[Controller::class,'getKind'])->name('get_kind');
