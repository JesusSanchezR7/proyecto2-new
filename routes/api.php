<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/empleados',[EmpleadoController::class,'index']);

Route::post('/empleados',[EmpleadoController::class,'create']);

Route::put('/empleados/{id}',[EmpleadoController::class,'update']);

Route::get('/empleados/{id}',[EmpleadoController::class,'show']);

Route::delete('/empleados/{id}',[EmpleadoController::class,'delete']);

// para saber cuantos empleados "masculinos" hay
//para saber cuantos empleados "femeninos" hay
//total de alumnos becados
//total de alumnos sin veca
//total de alumnos con horario matutino
//total de alumnos con horario verpertino
//total de alumnos que reprobaron en la prepa (si el alumno saco menos de 6 entonces lo cuentan como reprobado)
//total de alumnos que aprobaron la prepa (si el alumno saco mas de 6 entonces lo cuentan como aprobado)
//total de alumnos con problemas de salud
//total de alumnos sin problemas de salud

// todo eso es una sola /*/**/***/****/
Route::get('/empleados', [EmpleadoController::class,'datos_empleados']);



