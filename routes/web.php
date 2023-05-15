<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rout', function () {
    return view('index');
});

Route::post('/createrow', 'BlogController@createRow')->name('create.row');

//Route::get('/getdata', 'DataController@getData');

Route::get('/get-all-data', [DataController::class, 'getAllData']);

