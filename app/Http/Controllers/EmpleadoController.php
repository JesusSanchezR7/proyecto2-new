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
        'data'=>$empleados
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
            'mesage'=> 'Se creo con exito el empleado'
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

    public function generos (Request $Request)
    {
        $masculino =  Empleados::where("genero","masculino")->count();
        $femenino =  Empleado::where("genero","femenino")->count();
        return response([
            'masculinos'=>$masculino,
            'femeninos'=>$femenino,
        ]);
    }

    public function horarios (Request $Request)
    {
        $matu =  Empleado::where("horario","matutino")->count();
        $vesp =  Empleado::where("horario","vespertino")->count();

        return response([
            'vespertino'=>$vesp,
            'matutino'=>$matu,

        ]);
    }

    public function becas (Request $Request)
    {
        $nobeca =  Empleado::where("becado","no")->count();
        $beca =  Empleado::where("becado","si")->count();
        return response([
            'si'=>$beca,
            'no'=>$nobeca,
        ]);
    }

    public function salud (Request $Request)
    {
        $saludables =  Empleado::where("problemas_de_salud","si")->count();
        $nosaludables =  Empleado::where("problemas_de_salud","no")->count();


        return response([
            'sin_problemas_de_salud'=>$nosaludables,
            'problemas_de_salud'=>$saludables,
        ]);
    }

    public function reprobados_no_reprobados (Request $Request)
    {

        $reprobado =  Empleado::where("calificacion_prepa", "<=", "6")->count();
        $aprobado =  Empleado::where("calificacion_prepa",">=", "7")->count();

        return response([
            'reprobados' => $reprobado,
            'aprobados' => $aprobado,
        ]);
    }



}

