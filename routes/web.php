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

Route::get('AddToFav',[Controller::class,'CreatFav'])->name('AddToFav');

Route::get('/bedRoom',[Controller::class,'bedRooms'])->name('bed_rooms');

Route::get('/livingRoom',[Controller::class,'livingRoom'])->name('living_room');

Route::view('about', 'about')->name('about');

Route::view('account', 'account')->name('account');

Route::view('finalRoom', 'finalRoom')->name('finalRoom');

Route::get('design_room',[Controller::class,'designRoom'])->name('design_room');

Route::get('get_kind',[Controller::class,'getKind'])->name('get_kind');

Route::get('get_item_byID',[Controller::class,'getByID'])->name('get_item_byID');



Route::get('chepest',[Controller::class,'getchep'])->name('chepest');
