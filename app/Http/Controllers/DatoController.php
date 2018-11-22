<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatoController extends Controller
{
    protected $valores_tipo = 'dato';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista($accion = null)
    {
        //devolviendo a una vista 'mostrar' que está dentro de una subcarpeta 'datos'
        //es decir, datos.mostrar
        //(físicamente, está en: resources/views/datos/mostrar.blade.php)

        //return Dato::all();
        //$valores = Dato::all();
        $valores = DB::table($this->valores_tipo.'s')->get();

        //Devolviendo info a la vista correspondiente
        //----------------------------------------------------------
        return view('datos.mostrar')->with([
            'vista_tipo' => 'listado',
            'vista_tit' => 'Listado',
            'valores_tipo' => $this->valores_tipo,
            'valores' => $valores,
            'valoresTOT' => count($valores),
            'accion' => $accion,
        ]);
    }


    public function detalle($id = null)
    {
        $_arr_detalle = [];
        $_arr_detalle['vista_tipo'] = 'detalle';
        $_arr_detalle['vista_tit'] = 'Detalle';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        $valor = DB::table($this->valores_tipo.'s')->where('id', $id)->first();
        $_arr_detalle['valor'] = $valor;

        return view('datos.mostrar')->with($_arr_detalle);
    }


    /**
     * Crear un nuevo registro
     *
     * @return void
     */
    public function nuevo()
    {
        $_arr_detalle = [];
        $_arr_detalle['vista_tipo'] = 'crear';
        $_arr_detalle['vista_tit'] = 'Nuevo';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        return view('datos.nuevo')->with($_arr_detalle);
    }

    public function insertar(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'nombre' => 'required|max:190',
            'contrasenia' => 'required|max:190',
            'edad' => 'required|integer',
            'saldo' => 'required|numeric',
            'comentarios' => 'required|max:255',
        ];
        //Validando petición
        $request->validate($reglas);

        /*
        //Insertando nuevo registro
        //------------------------------------------------
        DB::table($this->valores_tipo.'s')->insert([
            'nombre' => $request->nombre,
            'contrasenia' =>  bcrypt($request->contrasenia),
            'edad' => $request->edad,
            'saldo' => $request->saldo,
            'comentarios' => $request->comentarios,
            'register_at' => $request->register_at,
            'activo' => $request->activo,
        ]);
        */

        /**/
        //Insertando nuevo registro y recuperando el ID
        //------------------------------------------------
        $id = DB::table($this->valores_tipo.'s')->insertGetId([
            'nombre' => $request->nombre,
            'contrasenia' =>  bcrypt($request->contrasenia),
            'edad' => $request->edad,
            'saldo' => $request->saldo,
            'comentarios' => $request->comentarios,
            'register_at' => $request->register_at,
            'activo' => $request->activo,
        ]);
        if(empty($id)) {
            //Log::error('Failed to insert row into database.');
            dd('ERROR al insertar en la tabla ['.$this->valores_tipo.'s'.'] de la base de datos. ['. $id.']');
        } else {
            //dd('Inserto efectuado. ['. $id.']');

            //Redirigiendo al Listado
            //==========================================
            //  -> Redirigiendo hacia nombre de Ruta
            ////return redirect()->route('datos_lista');
            $accion = 'insertar_'.$id;
            return redirect()->route('datos_lista', ['accion' => $accion]);
        }
    }


    public function editar(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'nombre' => 'required|max:190',
            'contrasenia' => 'required|max:190',
            'edad' => 'required|integer',
            'saldo' => 'required|numeric',
            'comentarios' => 'required|max:255',
        ];
        //Validando petición
        $request->validate($reglas);

        DB::table($this->valores_tipo.'s')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'contrasenia' => $request->contrasenia,
                    'edad' => $request->edad,
                    'saldo' => $request->saldo,
                    'comentarios' => $request->comentarios,
                    'register_at' => $request->register_at,
                    'activo' => $request->activo,
                ]);

        //Redirigiendo al Listado
        //==========================================
        //¡¡Así NO!!
        //$this->lista();
        //----------------------------
        //  -> Redirigiendo hacia método de Controlador
        ////return redirect()->action('DatoController@lista');
        //----------------------------
        //  -> Redirigiendo hacia nombre de Ruta
        ////return redirect()->route('datos_lista');
        $accion = 'editar_'.$request->id;
        return redirect()->route('datos_lista', ['accion' => $accion]);
    }


    public function editar_campo($id, $campo, $valor)
    {
        DB::table($this->valores_tipo.'s')
                ->where('id', $id)
                ->update([
                    $campo => $valor,
                ]);
        //$accion = 'editar_'.$id;
        //return redirect()->route('datos_lista', ['accion' => $accion]);
        return redirect()->route('datos_lista');
    }


    public function borrar($id)
    {
        DB::table($this->valores_tipo.'s')->where('id', $id)->delete();

        //Redirigiendo al Listado
        //==========================================
        //¡¡Así NO!!
        //$this->lista();
        //----------------------------
        //  -> Redirigiendo hacia método de Controlador
        ////return redirect()->action('DatoController@lista');
        //----------------------------
        //  -> Redirigiendo hacia nombre de Ruta
        ////$accion = [
        ////    'tipo' => 'borrar',
        ////    'id' => $id,
        ////];
        $accion = 'borrar_'.$id;
        return redirect()->route('datos_lista', ['accion' => $accion]);
    }
}
