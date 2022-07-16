<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function index(Request $request){

    $empleados = Empleado::all();
    return response([
        'total_data'=>count($empleados),
        'data'=>$empleados,

    ],200);
    }

    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'nombre' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'carrera' => 'required',
            'ednia_indigena' => 'required',
            'horario'  => 'required',
            'calificacion_prepa'  => 'required',
            'becado'  => 'required',
            'problemas_de_salud' => 'required'

        ]);

        Empleado::create($data);
        return response([
            'mesage'=> 'Se creo con exito el empleado',
        ],201);
    }

    public function show ($id)
    {
        $empleado= Empleado::find($id);
        return response($empleado);
    }

    public function update ($id,Request $request)
    {
        $data = $this->validate($request, [
            'nombre' => 'required',
            'telefono' => 'required',
            'edad' => 'required',
            'genero' => 'required',
            'carrera' => 'required',
            'ednia_indigena' => 'required',
            'horario'  => 'required',
            'calificacion_prepa'  => 'required',
            'becado'  => 'required',
            'problemas_de_salud' => 'required'
        ]);
        Empleado::find($id)->fill($data)->save();
        return response([
            'mesage'=> 'Se edito con exito el empleado'
        ]);
    }

    public function delete ($id,Request $request){
        Empleado::find($id)->delete();
        return response([
            'mesage'=> 'Se Elimino con exito el empleado'
        ]);
    }


    public function datos_empleados(Request $request){

        $empleados = Empleado::all();
        $masculinos = Empleado::where('genero', 'masculino')->get();
        $femenino = Empleado::where('genero', 'femenino')->get();
        $matu = Empleado::where('horario','matutino')->get();
        $vesp = Empleado::where('horario','vespertino')->get();
        $nobeca =  Empleado::where('becado','no')->get();
        $beca =  Empleado::where('becado','si')->get();
        $saludables =  Empleado::where('problemas_de_salud','si')->get();
        $nosaludables =  Empleado::where('problemas_de_salud','no')->get();
        $reprobado =  Empleado::where('calificacion_prepa', '<=', '6')->get();
        $aprobado =  Empleado::where('calificacion_prepa','>=', '7')->get();


        return response([
            'mesage'=> 'Examen de cuantos hay en una base de datos 20 registros',
            'Cuantos empleados hay: '=>count($empleados),
            'Cuantos Hombres hay: '=>count($masculinos),
            'Cuantos Mujeres hay: '=>count($femenino),
            'Cuantos se encuentran el la mañana'=>count($matu),
            'Cuantos se encuentran el la tarde'=>count($vesp),
            'Cuantos no tiene Beca :( '=>count($nobeca),
            'Cuantos tienen Beca   :) '=>count($beca),
            'Cuantos estan con buena salud' =>count($saludables),
            'Cuantos No tiene buena salud'=>count($nosaludables),
            'Cunatos estan reprobados:'=>count($reprobado),
            'Cuantos esta aprobados:'=>count($aprobado)
        ],200);
        }

}

