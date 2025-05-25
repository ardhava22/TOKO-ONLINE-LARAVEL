<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("/register_pelanggan",[AuthController::class,"register"]);
Route::get("/get_user",[AuthController::class,"getUser"]);
Route::get("/get_detail_user/{id}",[AuthController::class,"getDetailUser"]);
Route::put("/update_user/{id}",[AuthController::class,"update_user"]);
Route::delete("/hapus_user/{id}",[AuthController::class,"hapus_user"]);
Route::post("/login",[AuthController::class,"login"]);
Route::get("/logout",[AuthController::class,'logout']);
Route::get("/get_userrole",[AuthController::class,"getUser"])->middleware('role:kasir');

Route::group(["prefix"=>"kasir","middleware"=>"role:kasir"],function(){
    Route::post('/insertbarang',[TokoController::class,'insertBarang']);
    Route::get('/getbarang',[TokoController::class,'getBarang']);
    Route::get('/getdetailbarang/{id}',[TokoController::class,'getDetailBarang']);
    Route::post('/updatebarang/{id}',[TokoController::class,'updateBarang']);
    Route::delete('/hapusbarang/{id}',[TokoController::class,'hapusBarang']);
});



Route::middleware('auth:sanctum')->get('/user'  , function (Request $request) {
    return $request->user();
});

