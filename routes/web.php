<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

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
   
    $arrayQuantity1=[];
    $arraySize1=[];
    $Suplierno= 0;
     $Orderno= 0;
     return view('welcome',compact('arrayQuantity1','arraySize1','Suplierno','Orderno'));
               
});


Route::resource('fileUpload', ImportController::class);

Route::get('/import',[ImportController::class,'index']);