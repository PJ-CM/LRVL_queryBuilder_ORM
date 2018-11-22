<?php

namespace App\Http\Controllers;

use App\Dato;
use Illuminate\Http\Request;

class DatoEloqController extends Controller
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

        $valores = Dato::all();

        //Devolviendo info a la vista correspondiente
        //----------------------------------------------------------
        return view('datos.mostrar-eloq')->with([
            'vista_tipo' => 'listado',
            'vista_tit' => 'Listado con Eloquent',
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
        $_arr_detalle['vista_tit'] = 'Detalle con Eloquent';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        $valor = Dato::findOrFail($id);
        $_arr_detalle['valor'] = $valor;

        return view('datos.mostrar-eloq')->with($_arr_detalle);
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
        $_arr_detalle['vista_tit'] = 'Nuevo con Eloquent';
        $_arr_detalle['valores_tipo'] = $this->valores_tipo;

        return view('datos.nuevo-eloq')->with($_arr_detalle);
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

        //Insertando nuevo registro y recuperando el ID
        //------------------------------------------------
        $dato = Dato::create($request->all());
        if(empty($dato->id)) {
            //Log::error('Failed to insert row into database.');
            dd('ERROR al insertar en la tabla ['.$this->valores_tipo.'s'.'] de la base de datos. ['. $dato->id.']');
        } else {
            //dd('Inserto efectuado. ['. $dato->id.']');

            //Redirigiendo al Listado
            //==========================================
            //  -> Redirigiendo hacia nombre de Ruta
            ////return redirect()->route('datos_eloq_lista');
            $accion = 'insertar_'.$dato->id;
            return redirect()->route('datos_eloq_lista', ['accion' => $accion]);
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

        Dato::where('id', $request->id)
                ->update($request->except('_token'));


        /**
         * ¡¡CUIDADO!!
         * Si al UPDATE se le pasan todos los datos del POST
         * con el "$request->all()", esta llamada incluye también
         * al dato referido al "_token" que se inserta con el helper "@csrf"
         * Esto produce este ERROR:
         *      SQLSTATE[42S22]: Column not found: 1054 Unknown column '_token' in 'field list'
         * Para evitar este error, hay que indicar que se quiere pasar todo el POST excepto ese
         * registro del POST, es decir,
         *      $request->except('_token') // o request()->except('_token')
         */


        //Redirigiendo al Listado
        //==========================================
        //¡¡Así NO!!
        //$this->lista();
        //----------------------------
        //  -> Redirigiendo hacia método de Controlador
        ////return redirect()->action('DatoController@lista');
        //----------------------------
        //  -> Redirigiendo hacia nombre de Ruta
        ////return redirect()->route('datos_eloq_lista');
        $accion = 'editar_'.$request->id;
        return redirect()->route('datos_eloq_lista', ['accion' => $accion]);
    }


    public function editar_campo($id, $campo, $valor)
    {
        Dato::where('id', $id)
                ->update([
                    $campo => $valor,
                ]);
        //$accion = 'editar_'.$id;
        //return redirect()->route('datos_eloq_lista', ['accion' => $accion]);
        return redirect()->route('datos_eloq_lista');
    }


    public function borrar($id)
    {
        Dato::where('id', $id)->delete();

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
        return redirect()->route('datos_eloq_lista', ['accion' => $accion]);
    }
}
