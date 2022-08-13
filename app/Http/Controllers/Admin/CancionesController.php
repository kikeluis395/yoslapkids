<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tbl_cancion;
use App\Models\Tbl_estrofa;
use App\Models\Tbl_tipo_cancion;
use Illuminate\Http\Request;

class CancionesController extends Controller
{
    public function index() {
        return view('admin/canciones/index');
    }

    public function getCanciones() {
        $canciones = Tbl_cancion::all();
        foreach ($canciones as $cancion) {
            $acciones = "<a href='javascript:;'  style='text-decoration:none;' class='btn btn-warning edicion mr-2'>
            <i class='fas fa-edit'></i></a>";
            $cancion->acciones = $acciones;    
            $cancion->numero_estrofas = count($cancion->estrofas);
            $cancion->tipo_cancion = $cancion->tipo->tipo_cancion_nombre;
        }
        echo json_encode($canciones);
    }

    public function create() {
        $tipos_canciones = Tbl_tipo_cancion::all();
        return view('admin/canciones/create', compact('tipos_canciones'));
    }

    public function store (Request $request) {
        try {
            $cancion = new Tbl_cancion();
            $cancion->cancion_titulo = $request->cancion_titulo;
            $cancion->id_tipo_cancion = $request->tipo_cancion;
            $cancion->cancion_numero_estrofas = count($request->estrofas);
            $cancion->cancion_nota = $request->cancion_nota;
    
            $cancion->save();
    
            foreach ($request->estrofas as $estrofa) {
                $estrofa_nueva = new Tbl_estrofa();
                $estrofa_nueva->id_cancion = $cancion->id_cancion;
                $estrofa_nueva->estrofa_contenido = $estrofa;
                $estrofa_nueva->save();
            }
            echo json_encode(['error' => 0, 'message' => 'Canción agregada correctamente']);

        } catch (\exception $e) {
            echo json_encode(['error' => 1, 'message' => $e->getMessage()]);
        }
       

    }
}
