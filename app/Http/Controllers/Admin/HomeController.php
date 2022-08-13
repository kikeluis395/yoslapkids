<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function getPersonas()
    {
        $personas = Persona::where('persona_estado', '1')->get();

        foreach ($personas as $persona) {
            // falta editar el cliente
            $opciones = "<a href='javascript:;'  onclick='editarPersona(" . $persona->persona_id . ")' style='text-decoration:none;' class='btn btn-warning edicion mr-2' data-id='" . $persona->persona_id . "'>
            <i class='fas fa-edit'></i></a>";
            $opciones .= "<a href='javascript:;' style='text-decoration:none;' class='btn btn-danger' onclick='eliminarPersona(" . $persona->persona_id . ")'>
            <i class='fas fa-trash-alt'></i></a>";
            $persona->opciones = $opciones;

            $persona->celular = $persona->celular ? $persona->celular : 'No tiene';
        }
        echo json_encode($personas);
    }
    public function insertPersona()
    {
        $persona = new Persona();
        $persona->nombres = request()->nombres;
        $persona->apellidos = request()->apellidos;
        $persona->celular = request()->celular;
        $persona->edad = request()->edad;
        $persona->sexo = request()->sexo;
        $persona->persona_estado = 1;
        if (intval(request()->edad) <= 12) {
            $persona->tipo_persona = 'Niño';
        } else {
            $persona->tipo_persona = 'Adulto';
        }
        $persona->save();

        if ($persona) {
            echo json_encode(['error' => 0, 'msn' => 'La persona ha sido creada con exito']);
        } else {
            echo json_encode(['error' => 1, 'msn' => 'No se ha podido crear a la persona']);
        }
    }

    public function eliminarPersona()
    {
        $persona = Persona::find(request()->persona_id);
        if ($persona) {
            try {
                $persona->persona_estado = '0';
                $persona->save();
                echo json_encode(['error' => 0, 'msn' => 'La persona ha sido desactivada con exito']);
            } catch (\Throwable $th) {
                echo json_encode(['error' => 1, 'msn' => 'La persona no se ha podido desactivar']);
            }
        } else {
            echo json_encode(['error' => 1, 'msn' => 'La persona no se ha encontrado']);
        }
    }

    public function getDatosPersona()
    {
        $persona = Persona::find(request()->persona_id);
        echo json_encode($persona);
    }

    public function editarPersona()
    {
        $persona = Persona::find(request()->persona_id);
        if ($persona) {
            try {
                $persona->nombres = request()->nombres;
                $persona->apellidos = request()->apellidos;
                $persona->celular = request()->celular;
                $persona->edad = request()->edad;
                $persona->sexo = request()->sexo;
                $persona->save();
                echo json_encode(['error' => 0, 'msn' => 'La persona ha sido modificada con exito']);
            } catch (\Throwable $th) {
                echo json_encode(['error' => 1, 'msn' => 'La persona no se ha podido modificar']);
            }
        } else {
            echo json_encode(['error' => 1, 'msn' => 'La persona no se ha encontrado']);
        }
    }
}
